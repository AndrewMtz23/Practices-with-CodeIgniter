# Practice 6: React & PHP REST API Dashboard

## Overview

Practice 6 modernizes the client tier by migrating from multi-page server-rendered views to a **React 18 Single Page Application (SPA)**. The application consolidates the functionalities explored in previous practices—including Highcharts data visualization, Google Maps geospatial rendering, and asynchronous CRUD operations—into a unified component-driven frontend consuming the CodeIgniter PHP REST backend.

---

## Technical Stack

* **Frontend Library:** React 18.3.1
* **Routing:** React Router DOM 6.26.0
* **Component Architecture:** Functional Components with React Hooks (`useState`, `useEffect`, `useCallback`)
* **Styling & Layout:** Bootstrap 5.3.3, React-Bootstrap 2.10.4
* **Charting Suite:** Highcharts 11.4.6, `highcharts-react-official` 3.2.1
* **Mapping Engine:** `@vis.gl/react-google-maps` 1.1.0
* **Iconography:** FontAwesome for React (`@fortawesome/react-fontawesome`)
* **Backend Dependency:** CodeIgniter 3 REST Services (Practices 1, 2, and 3)

---

## Application Structure

```text
practica6/
├── build/                      # Production-ready compiled assets and bundles
│   ├── static/
│   │   ├── css/                # Minified stylesheet bundles
│   │   └── js/                 # Webpack JavaScript chunks
│   ├── index.html              # SPA entry point
│   └── manifest.json           # Web application manifest
├── package.json                # Project dependencies and script declarations
└── README.md                   # Technical documentation
```

---

## Architecture & Data Flow

1. **State Management & Asynchronous Ingestion:**
   Components dispatch HTTP `fetch` requests directly to the CodeIgniter backend endpoints. Standard headers (`Accept: application/json`, `Content-Type: application/json`) ensure smooth interoperability with the dual-input stream parsing built into the PHP controllers.

2. **Declarative Component Composition:**
   * **Analytics View:** Embeds `<HighchartsReact highcharts={Highcharts} options={chartOptions} />` to visualize student performance and climate datasets dynamically.
   * **Geospatial View:** Utilizes `@vis.gl/react-google-maps` declarative wrappers (`<APIProvider>`, `<Map>`, `<Marker>`) to render coordinate markers without direct DOM manipulation.
   * **Catalog View:** Renders responsive React-Bootstrap tables and modal dialogues for data maintenance.

---

## Build & Deployment Scripts

* **Run Development Server:**
  ```bash
  npm start
  ```
  Launches local webpack development server at `http://localhost:3000`.

* **Generate Production Bundle:**
  ```bash
  npm run build
  ```
  Compiles optimized production assets into the `build/` directory with cache-busting hashes.

---

## Production Deployment Note

The compiled build is pre-configured with the relative asset base path:
```json
"homepage": "http://dtai.uteq.edu.mx/~morand218/practica6/build/"
```
When running locally behind an Apache virtual host, serve the `build/` directory directly or update the `homepage` property in `package.json` prior to executing `npm run build`.
