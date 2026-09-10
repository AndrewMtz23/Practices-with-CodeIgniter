# Practice 4: Google Maps JavaScript API with Interactive Events

## Overview

Practice 4 explores client-side geospatial programming using the **Google Maps JavaScript API**. The application provides an interactive mapping dashboard that captures user-triggered click events on the map canvas, generates dynamic geographical markers, tracks coordinate history within an active selection interface, and controls marker animation states programmatically.

---

## Technical Stack

* **Platform:** Static Client-Side Web Application
* **Mapping Engine:** Google Maps JavaScript API
* **Libraries:** jQuery 3.7.1, Bootstrap 5.3.3
* **Icons & Styling:** FontAwesome 6, Custom Responsive CSS
* **Data Structures:** In-memory coordinate arrays and marker object references

---

## Functional Architecture

The interface is structured in a two-column responsive layout:
* **Map Viewport (`#divmapa`):** Primary canvas initialized at preset geographical coordinates (Querétaro, Mexico: `20.5909`, `-100.3948`).
* **Control Panel:** Multi-line selection box (`#posiciones`) paired with action buttons managing marker lifecycles.

---

## Event Handling & API Capabilities

1. **Map Click Listener:**
   Registers a global click event on the `google.maps.Map` instance to extract exact latitude and longitude:
   ```javascript
   mapa.addListener('click', function(e) {
       var lat = e.latLng.lat();
       var lng = e.latLng.lng();
       agregaMarcador(lat, lng);
   });
   ```

2. **Dynamic Marker Placement:**
   Instantiates `google.maps.Marker` objects upon capture, binds informational titles, and synchronizes the marker collection with an HTML `<select>` list.

3. **Animation Control:**
   * **Trigger Animation (`#btn-animar`):** Sets `marker.setAnimation(google.maps.Animation.BOUNCE)` on the selected marker.
   * **Stop Animation (`#btn-detener`):** Reverts animation state to `null`.

4. **Marker Deletion (`#btn-eliminar`):**
   Detaches the selected marker from the map canvas (`marker.setMap(null)`), removes the corresponding reference from the internal marker registry, and refreshes the coordinate select list.

---

## Local Setup

1. This practice runs directly in any modern browser without requiring a backend server.
2. Note that the Google Maps script tag references an API key:
   ```html
   <script async src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=creamapa"></script>
   ```
   For production deployments or custom domains, replace the key parameter with your personal Google Cloud Platform credentials authorized for the Maps JavaScript API.
3. Serve the directory via your local web server (e.g., Apache/XAMPP) or open `index.html` directly:
   ```text
   http://localhost/Practices-with-CodeIgniter/practica4/
   ```
