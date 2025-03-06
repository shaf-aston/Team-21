const products = [
    {
        id: 1,
        title: "APPLE 11\" iPad Air (2024) - 128 GB, Space Grey",
        price: "£599.00",
        description: "Experience power and portability with the APPLE 11\" iPad Air. Perfect for work and play, with a sleek design and powerful performance.",
        image: "Images/iPadAir.svg",
    },
    {
        id: 2,
        title: "LENOVO Tab P12 12.7\" Tablet - 128 GB, Storm Grey",
        price: "£229.00",
        description: "A versatile tablet for productivity and entertainment with a sleek design and long battery life.",
        image: "Images/Lenovo.svg",
    },
    {
        id: 3,
        title: "LENOVO Tab Plus 11.5\" Tablet with Sleeve - 128 GB, Luna Grey",
        price: "£199.00",
        description: "A budget-friendly tablet with powerful performance, perfect for everyday tasks and media consumption.",
        image: "Images/LenovoPlus.svg",
    },
    {
        id: 4,
        title: "SAMSUNG Galaxy Tab A9+ 8.7\" Tablet - 64 GB, Graphite",
        price: "£154.00",
        description: "A compact and affordable tablet, ideal for browsing, streaming, and light productivity.",
        image: "Images/Samsung.svg",
    },
    {
        id: 5,
        title: "SAMSUNG Galaxy Tab S9 FE 10.9\" 5G Tablet",
        price: "£1469.00",
        description: "A premium tablet with 5G connectivity, offering top-tier performance for work, entertainment, and gaming.",
        image: "Images/Samsung2.svg",
    },
];

// Get the product ID from the URL
const urlParams = new URLSearchParams(window.location.search);
const productId = parseInt(urlParams.get("id"));

// Check if productId exists
if (productId) {
    const product = products.find((p) => p.id === productId);
    if (product) {
        // Populate the product details
        document.getElementById("product-details").innerHTML = `
            <h1>${product.title}</h1>
            <img src="${product.image}" alt="${product.title}" class="product-image">
            <p class="product-description">${product.description}</p>
            <p class="product-price">Price: ${product.price}</p>
            <button class="add-button">Add to Basket</button>
        `;
    } else {
        // Display error if product is not found
        document.getElementById("product-details").innerHTML = `<p>Product not found!</p>`;
    }
} else {
    document.getElementById("product-details").innerHTML = `<p>No product selected!</p>`;
}