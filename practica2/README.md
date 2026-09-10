# Practice 2: Data Visualization with Highcharts JS

## Overview

Practice 2 centers on integrating charting libraries with PHP/CodeIgniter backends to render interactive statistical data. It demonstrates how to transform relational database rows into JSON series models required by **Highcharts JS**, incorporating multi-series line charts, export capabilities, and localized chart interfaces.

---

## Architectural Layout

* **`webservice/`**: Exposes REST endpoints querying monthly meteorological metrics across multiple international cities stored in the `temperaturas` table.
* **`app/`**: Client interface loading the Highcharts ecosystem and dispatching AJAX requests to populate line series dynamically.

---

## Technical Stack

* **Backend Framework:** CodeIgniter 3.1.x (PHP)
* **Frontend Libraries:** Highcharts JS 11.x, jQuery 3.7.1, Bootstrap 5
* **Highcharts Modules:**
  * `series-label`: Inline labeling of individual lines
  * `exporting`: Client-side image/document export (PNG, JPEG, PDF, SVG)
  * `export-data`: Tabular data preview and CSV/XLS export
  * `accessibility`: Screen reader and keyboard navigation compliance
  * `highcharts-lang-ES`: Spanish language localization for buttons and metric tooltips
* **Database:** MySQL (tables: `temperaturas`, `meses`)

---

## Database Schema Context

The application queries data structured around two key tables:
* `meses`: Stores calendar month identifiers (`idmes`: 1 to 12) and abbreviations (`nommes`).
* `temperaturas`: Stores recorded temperatures per city per month (`ciudad`, `idmes`, `temperatura`).

---

## Service Endpoints

Hosted in `webservice/application/controllers/Back.php`:

| HTTP Method | Endpoint | Description |
| :--- | :--- | :--- |
| `GET`, `POST` | `/back/temperaturas` | Returns monthly temperatures grouped by city formatted as Highcharts-compatible series objects. |
| `GET`, `POST` | `/back/ciudades` | Returns distinct city listings available in the dataset. |

---

## Implementation Details

1. **Series Data Transformation:**
   The backend model (`Temperaturas_model.php`) aggregates records by grouping measurements under corresponding city keys, ensuring each series array maps directly to the 12 calendar month intervals.

2. **Client-Side Chart Configuration:**
   The client script (`grafica.js`) initializes the `Highcharts.chart` object:
   * Sets custom titles, subtitles, and axis labels (`°C`).
   * Configures tooltip templates for hover state inspection.
   * Maps server-returned JSON arrays to chart series via `chart.addSeries()`.

3. **Responsive Chart Layout:**
   Highcharts configuration rules adapt stroke widths and legend alignments dynamically according to viewport dimensions.

---

## Local Setup

1. Confirm `bd_awi4_t218.sql` has been imported into MySQL.
2. Update database credentials in `webservice/application/config/database.php`.
3. Set base URLs in both `app` and `webservice` `config.php` files.
4. Launch the application in a web browser:
   ```text
   http://localhost/Practices-with-CodeIgniter/practica2/app/
   ```
