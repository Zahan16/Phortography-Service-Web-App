function loadPackageDetails(serviceType) {
    fetch(`path/to/fetch_packages.php?service=${serviceType}`)
        .then(response => response.json())
        .then(packages => {
            const packagesContent = document.getElementById('packagesContent');
            packagesContent.innerHTML = ''; // Clear existing content
            packages.forEach(package => {
                const packageDiv = document.createElement('div');
                packageDiv.className = 'package';

                const title = document.createElement('h2');
                title.textContent = package.title;

                const description = document.createElement('p');
                description.textContent = package.description;

                const price = document.createElement('p');
                price.textContent = `Price: $${package.price}`;

                packageDiv.appendChild(title);
                packageDiv.appendChild(description);
                packageDiv.appendChild(price);
                packagesContent.appendChild(packageDiv);
            });
        })
        .catch(error => console.error('Error loading packages:', error));
}
