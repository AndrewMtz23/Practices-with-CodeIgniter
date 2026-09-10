# Practice 8: Social Authentication with Facebook OAuth in React

## Overview

Practice 8 implements federated social authentication leveraging the **OAuth 2.0** protocol through the **Facebook Graph API** within a React Single Page Application. The application replaces standard username/password forms with a third-party identity provider, securely ingests the user's authenticated profile tokens, and carries the authenticated session state into a protected dashboard route.

---

## Technical Stack

* **Frontend Library:** React 18.2.0
* **OAuth Client:** `react-facebook-login` 4.1.1
* **Client Routing:** React Router DOM 6.22.3
* **Protocol:** OAuth 2.0 / Facebook Graph API
* **Build System:** React Scripts (Create React App)

---

## Project Structure

```text
practica8/
├── public/                     # Static HTML template and public assets
├── src/
│   ├── css/                    # Application and component stylesheets
│   ├── App.js                  # Login gateway hosting the Facebook OAuth component
│   ├── home.js                 # Protected user dashboard presenting profile attributes
│   ├── MainRouter.js           # Client-side route declarations (/ and /home)
│   └── index.js                # React DOM render entry point
├── package.json                # Dependencies and project metadata
└── README.md                   # Technical documentation
```

---

## Authentication Workflow

1. **Authorization Request:**
   The user triggers the OAuth flow by clicking the `<FacebookLogin>` component in `App.js`. This requests permissions for the declared profile scopes:
   ```javascript
   <FacebookLogin
       appId="YOUR_FACEBOOK_APP_ID"
       autoLoad={false}
       fields="name,email,picture"
       callback={responseFacebook}
       textButton="Iniciar sesión con Facebook"
       icon="fa-facebook"
   />
   ```

2. **Callback Handling & Token Ingestion:**
   Upon successful user confirmation, Facebook returns an access token alongside the requested payload:
   ```javascript
   const responseFacebook = (response) => {
       if (response && response.name && response.email && response.picture) {
           navigate('/home', { state: { userData: response } });
       } else {
           console.error('Authentication error or user cancellation:', response);
       }
   };
   ```

3. **State Persistence & Dashboard Rendering:**
   `home.js` consumes the navigation location state (`useLocation`), extracts `userData`, and dynamically renders:
   * Full authenticated name
   * Registered email address
   * Secure profile avatar loaded directly from Facebook's CDN

---

## Local Setup & Configuration

1. **Install Dependencies:**
   In the `practica8/` directory, install all required packages:
   ```bash
   npm install
   ```

2. **Facebook App ID Configuration:**
   Open `src/App.js` and set your registered **Facebook App ID** obtained from the [Meta for Developers Portal](https://developers.facebook.com/):
   * Ensure `http://localhost:3000/` is registered under Authorized OAuth Redirect URIs in your Meta Developer App settings.

3. **Run the Application:**
   ```bash
   npm start
   ```
   Open `http://localhost:3000` in your browser.
