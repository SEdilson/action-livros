import React, { Component } from 'react';
import './css/menu-css.css';
import './css/main.css';
import {Link} from 'react-router-dom';

class App extends Component {
  
  render() {
    return (
      <div>
        <nav className="menu">
          <ul>
              <Link to="/"><li>Home</li></Link>
              <Link to="/livro"><li>Livro</li></Link>
              <Link to="/autor"><li>Autor</li></Link>
              <Link to="/editora"><li>Editora</li></Link> 
          </ul>
        </nav>

        <div className="form-action">
          {this.props.children}
        </div>
      </div>
    );
  }
}

export default App;
