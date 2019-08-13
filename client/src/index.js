import React from 'react';
import ReactDOM from 'react-dom';
import App from './App';
import './index.css';
import AutorPage from './Autor';
import LivroPage from './Livro';
import EditoraPage from './Editora';
import HomePage from './Home';
import {BrowserRouter as Router, Route, Switch} from 'react-router-dom';

ReactDOM.render(
  <Router>
    <App>
      <Switch>
        <Route exact path="/" component={HomePage}/>
        <Route path="/autor" component={AutorPage}/>
        <Route path="/livro" component={LivroPage}/>
        <Route exact path="/editora" component={EditoraPage}/>
      </Switch>
    </App>
  </Router>,
  document.getElementById('root')
);
