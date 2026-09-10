# Practice 5c: Database-Driven Student Geolocation with Google Maps

## Overview

Practice 5c bridges relational database records with geospatial coordinates by integrating **Google Maps JavaScript API** directly into an academic management workflow. The application displays student records ingested from the RESTful web service developed in Practice 3, opens interactive modal map dialogues for any selected student, and persists updated latitude and longitude values directly back to the database.

---

## Architectural Workflow

The application acts as a composite consumer client:
1. **Catalog Retrieval:** Dispatches an AJAX call to Practice 3's backend (`/practica3/webservice/back/alumnos`) to retrieve the student roster.
2. **Modal Geolocation:** When the geolocation action is selected on a student row, a Bootstrap modal renders an embedded Google Map centered either at the student's existing recorded coordinates or at a default regional epicenter.
3. **Coordinate Persistence:** The user repositions the marker by clicking on the map canvas. Clicking "Guardar" sends an asynchronous update payload to the backend to update `latitud` and `longitud` columns in the `alumnos` table.

---

## Technical Stack

* **Client Framework:** CodeIgniter 3.1.x (Views & Asset pipeline)
* **Backend Dependency:** Practice 3 RESTful Web Service (`../practica3/webservice/`)
* **Mapping Technology:** Google Maps JavaScript API
* **Frontend Libraries:** jQuery 3.7.1, Bootstrap 5, FontAwesome 6
* **Database Engine:** MySQL (table: `alumnos`, columns: `latitud`, `longitud`)

---

## Database Columns Used

Within the `alumnos` table:
* `matricula` (CHAR 10, Primary Key)
* `latitud` (DECIMAL 18,12)
* `longitud` (DECIMAL 18,12)

---

## Implementation Details

1. **Decoupled API Endpoint Ingestion:**
   The frontend defines its target service base path dynamically in the view header:
   ```javascript
   var appData = {
       uri_app: "<?= base_url() ?>",
       uri_ws:  "<?= base_url() ?>../../practica3/webservice/"
   };
   ```

2. **Modal Map Initialization & Event Binding:**
   Google Maps canvases embedded inside modal windows require explicit dimension reflow triggers once the container is fully revealed. The client binds to Bootstrap's `shown.bs.modal` event:
   ```javascript
   $('#modal-mapa').on('shown.bs.modal', function() {
       google.maps.event.trigger(mapa, "resize");
       mapa.setCenter(centro);
   });
   ```

3. **Geospatial Coordinate Capture:**
   Clicking on the modal map captures `e.latLng.lat()` and `e.latLng.lng()`, positions a single draggable marker, and stages the values for transactional persistence.

---

## Local Setup

1. Verify that `practica3` is fully operational and accessible at the expected relative path.
2. Ensure `bd_awi4_t218.sql` has been imported into MySQL.
3. Configure `app/application/config/config.php` with your local base URL:
   ```php
   $config['base_url'] = 'http://localhost/Practices-with-CodeIgniter/practica5c/app/';
   ```
4. Access the application in your browser:
   ```text
   http://localhost/Practices-with-CodeIgniter/practica5c/app/
   ```
