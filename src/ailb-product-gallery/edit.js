import { useBlockProps } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import { ComboboxControl } from '@wordpress/components';
import { useState, useEffect } from '@wordpress/element';
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
	const { products } = attributes;
	const [searchTerm, setSearchTerm] = useState('');
	const [options, setOptions] = useState([]);

	// Fetch posts when search term changes
	const posts = useSelect(select => {
		return select('core').getEntityRecords('postType', 'item', { search: searchTerm, per_page: 10 });
	}, [searchTerm]);

	// Update the options state when posts are fetched
	useEffect(() => {
		if (posts) {
			setOptions(posts.map(post => ({ label: post.title.rendered, value: post.id })));
		}
	}, [posts]);

	// Fetch the selected post when postID changes
	const productPostData = useSelect((select) => {
		return select('core').getEntityRecords('postType', 'item', {
			include: products,
			per_page: products.length,
			_embed: true,
		});
	}, [products]);

	// Debugging
	useEffect(() => console.log('products: ', products), [products]);

	const handleAddValue = (value) => {
		console.log('value :', value);
		// Check if the value is already in the products array
		if (products.includes(value) || !value) return;

		// Add the value to the products array
		const newProducts = [...products, value];
		// Update the products attribute
		setAttributes({ products: newProducts });
	}

	return (
		<div {...useBlockProps()}>
			<div className="product-gallery">
				<div className="product-gallery__controls">
					<ComboboxControl
						label="Search and Select items"
						options={options}
						onInputChange={(value) => setSearchTerm(value)}
						onChange={(value) => handleAddValue(value)}
					/>
				</div>
				{productPostData && (
					<div className="product-gallery__content">
						{productPostData.map((post) => {
							const title = post.title.rendered;
							const image = post._embedded?.['wp:featuredmedia']?.[0]?.source_url || '';

							return (
								<div className="product-item" key={post.id}>
									{image && <img src={image} alt={title} />}
									<h2 className="title">{title}</h2>
								</div>
							);
						})}
					</div>
				)}
			</div>
		</div>
	);
}