import React from 'react';
import { useLocation, useNavigate } from 'react-router-dom';
import './css/Urls.css'; 

function Home() {
  const location = useLocation();
  const navigate = useNavigate();
  const userData = location.state?.userData;

  const logoutFacebook = () => {
    navigate('/');
  };

  React.useEffect(() => {
    if (userData) {
      console.log("Datos del usuario recibidos en Urls.js:", userData);
    } else {
      console.error('No se recibieron datos del usuario.');
    }
  }, [userData]);

  const handleLinkClick = (url) => {
    window.open(url, '_blank'); // -> Abre en una nueva pestaña
  };

  return (
    <div className="container">
      {userData ? (
        <div className="user-info">
          {userData.picture && userData.picture.data && userData.picture.data.url && (
            <img 
              src={userData.picture.data.url} 
              alt="Foto del usuario" 
              onError={ (e) => {
                e.target.onerror = null;
                e.target.src = 'https://via.placeholder.com/100';
              }}
            />
          )}
          <div className="details">
            <p style={{ fontSize: '18px', fontWeight: 'bold' }}>{userData.name}</p>
            <p style={{ fontSize: '16px' }}>{userData.email}</p>
          </div>
          <button 
            onClick={logoutFacebook} 
            className="logout-button"
          >
            <i className="fa fa-sign-out"></i> Salir
          </button>
        </div>
      ) : (
        <p>No se encontraron datos del usuario.</p>
      )}
      <h1 style={{ fontSize: '28px', marginBottom: '20px' }}>Prácticas del Curso Awi 4.0</h1>
      <ul className="practice-list">
        {[
          { name: 'Práctica 1 - API Rest con CodeIgniter',          url: "http://dtai.uteq.edu.mx/~morand218/practica1/app/" },
          { name: 'Práctica 2 - Highcharts',                        url: "http://dtai.uteq.edu.mx/~morand218/practica2/app/" },
          { name: 'Práctica 3 - Single View App con Highcharts',    url: "http://dtai.uteq.edu.mx/~morand218/practica3/app/" },
          { name: 'Práctica 4 - Google Maps API con eventos',       url: "http://dtai.uteq.edu.mx/~morand218/practica4" },
          { name: 'Práctica 5 - API Google Maps con BD',            url: "http://dtai.uteq.edu.mx/~morand218/practica5/app/" },
          { name: 'Práctica 6 - API Rest con React/PHP',            url: "http://dtai.uteq.edu.mx/~morand218/practica6/build/" }
        ].map((practice, index) => (
          <li key={index}>
            <button 
              onClick={() => handleLinkClick(practice.url)} 
              className="practice-button"
            >
              {practice.name}
            </button>
          </li>
        ))}
      </ul>
    </div>
  );
}

export default Home;
