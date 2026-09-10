// MainRouter.js
import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import App from './App'; // componente principal
import Home from './home'; // componente pa redirigir

function MainRouter({ userData }) {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<App />} /> 
        <Route path="/home" element={<Home userData={userData} />} /> {/* -> Pasa los datos del usuario como prop a Urls */}
      </Routes>
    </Router>
  );
}

export default MainRouter;
 