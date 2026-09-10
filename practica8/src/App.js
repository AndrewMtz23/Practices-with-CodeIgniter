import FacebookLogin from 'react-facebook-login';
import { useNavigate } from 'react-router-dom';
import './css/App.css';
import './MainRouter';

function App() {
  const navigate = useNavigate();

  // -> Función que maneja la respuesta de Facebook después de que el usuario inicie sesión.
  const responseFacebook = (response) => {

    if (response && response.name && response.email && response.picture && response.picture.data && response.picture.data.url) {
      console.log("Este es el nombre completo del usuario: ", response.name);
      console.log("Este es el correo del usuario: ", response.email);
      console.log("Esta es la foto del usuario: ", response.picture.data.url);

      // -> Pasar los datos del usuario al navegar
      navigate('/home', { state: { userData: response } });
    } else { // -> Si se da cancelar y no jala datos me manda esto 
      console.error('Error en la respuesta de Facebook:', response);
    }
  }

  return (
    <div className="App">
      <h1 className="ig fa-2x">Login con FB</h1> 
      <br /><br />

      <FacebookLogin
        //Para Calar en el Servidor (Awi4_Uteq_Server)
        //appId="1235066634345709"

        //Para Andres Mtz:
        //appId="521343263626809"

        //Para Andres Iscariote:
        appId="482374381093484"
        
        autoLoad={true} //me carga mi cuenta de fb
        fields="name,email,picture"
        callback={responseFacebook} // -> Mando a llamar mi manejo de sesion 
        textButton="Iniciar sesión con Facebook"
        icon="fa-facebook"
      />
    </div>
  );
}

export default App;
