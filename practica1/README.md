# Practice 1: RESTful Web Service with CodeIgniter 3

## Overview

Practice 1 demonstrates the development and consumption of a RESTful web service implemented in CodeIgniter 3. The architecture separates the project into two distinct subsystems: a backend service layer (`webservice`) providing data access with multi-format content negotiation (JSON and XML), and a client-facing web application (`app`) that communicates with the service via asynchronous HTTP requests (AJAX).

---

## Architectural Separation

* **`webservice/`**: Exposes HTTP endpoints for catalog querying and promotional CRUD operations. Includes Cross-Origin Resource Sharing (CORS) headers and custom view templates for XML output generation.
* **`app/`**: Client interface built on top of CodeIgniter views and jQuery. Handles form validations, dynamic DOM manipulation, and asynchronous communication with the backend service.

---

## Technical Stack

* **Backend Framework:** CodeIgniter 3.1.x (PHP)
* **Frontend Components:** HTML5, CSS3, JavaScript (ES6), jQuery 3.7.1
* **Styling & UI:** Bootstrap, FontAwesome 6
* **Database Management:** MySQL / MariaDB via CodeIgniter Query Builder
* **Data Interchange Formats:** JSON, XML

---

## Service Endpoints

All endpoints are hosted within the `Back` controller (`webservice/application/controllers/Back.php`):

| HTTP Method | Endpoint | Parameters | Response Format | Description |
| :--- | :--- | :--- | :--- | :--- |
| `GET`, `POST` | `/back/productos` | None | JSON | Retrieves all available products from the catalog. |
| `POST` | `/back/promociones` | `formato` (`json` \| `xml`) | JSON / XML | Returns promotional records based on requested serialization format. |
| `POST` | `/back/promocion` | `idpromocion` (int) | JSON | Fetches a single promotion by primary key. |
| `POST` | `/back/agrega_promocion` | `idproducto`, `precio`, `existencia`, `descuento`, `fecinicio`, `vigente` | JSON | Inserts a new promotional record. |
| `POST` | `/back/modifica_promocion` | `idpromocion`, `precio`, `existencia`, `descuento`, `fecinicio`, `vigente` | JSON | Updates an existing promotional record. |
| `POST` | `/back/elimina_promocion` | `idpromocion` (int) | JSON | Removes a promotion record from the database. |

---

## Key Features

1. **Content Negotiation (JSON & XML):**
   The `/back/promociones` method evaluates the `formato` parameter. When `xml` is specified, CodeIgniter sets `Content-Type: application/xml` and compiles an XML view template (`promociones_view_xml.php`). Otherwise, it sets `Content-Type: application/json` and serializes the response.

2. **CORS Configuration:**
   The service controller constructor enforces standard headers allowing decoupled client applications to interact with the API across different domains or local port bindings:
   ```php
   header("Access-Control-Allow-Origin: *");
   header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
   ```

3. **Asynchronous Frontend Interface:**
   The client application utilizes `jQuery.ajax` wrappers (`inicio.js`) to perform real-time table rendering, form resets, and interactive notifications using custom modal dialogues.

---

## Local Setup

1. Verify that `bd_awi4_t218.sql` has been imported into your MySQL server.
2. Configure the database credentials in `webservice/application/config/database.php`.
3. Set the base URLs in both `config.php` files:
   * Client: `app/application/config/config.php`
   * Backend: `webservice/application/config/config.php`
4. Access the client application via your web browser:
   ```text
   http://localhost/Practices-with-CodeIgniter/practica1/app/
   ```
