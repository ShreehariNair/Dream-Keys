document.addEventListener('DOMContentLoaded', async () => {
    const container = document.getElementById('properties-container');
  
    try {
      const response = await fetch('get_details.php');
      const result = await response.json();
  
      if (result.status === 'success') {
        result.data.forEach(property => {
          const card = document.createElement('div');
          card.className = 'property-card';
          card.innerHTML = `
            <img src="${property.image_url.split('|')[0]}" alt="Property" class="property-img">
            <div class="property-info">
              <h3>Owner: ${property.Owner}</h3>
              <p>Location: ${property.City}</p>
              <p>Size: ${property.Size} sqft</p>
              <form method="POST" action="remove.php" onsubmit="return confirm('Are you sure you want to remove this property?')">
                <input type="hidden" name="property_id" value="${property.property_id}">
                <button type="submit" class="remove-btn">Remove</button>
              </form>
            </div>
          `;
          container.appendChild(card);
        });
      } else {
        container.innerHTML = `<p>${result.message}</p>`;
      }
  
    } catch (error) {
      container.innerHTML = `<p>Error loading properties.</p>`;
      console.error(error);
    }
  });

  window.addEventListener('DOMContentLoaded', async () => {
    try {
        const res = await fetch('get_details.php'); // This will respond with session data
        const data = await res.json();

        if (data.status === 'success') {
            document.getElementById('username-heading').textContent = data.data.username;
        } else {
            document.getElementById('username-heading').textContent = 'Guest';
        }
    } catch (err) {
        console.error('Failed to fetch user info:', err);
        document.getElementById('username-heading').textContent = 'Error';
    }
});
  