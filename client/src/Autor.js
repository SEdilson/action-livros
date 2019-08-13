import React, { Component } from 'react';
import dateFormat from 'dateformat';
import './css/main.css';

export default class Autor extends Component {

    constructor() {
        super();
        this.state = {nome_autor: '', data_nasc: ''};
    }

    enviaDados(evento) {
        evento.preventDefault();

        const requestInfo = {
            method: 'POST',
            body: JSON.stringify({nome_autor:this.nome_autor.value, data_nasc:this.data_nasc.value})
        };

        fetch('http://localhost:8000/autor/create.php', requestInfo)
            .then((response, { alert }) => {
                if(response.ok) {
                    return response.json();
                } else {
                    throw new Error("Não foi possível enviar os dados")
                }
            })
            .then(nome_autor => this.setState({nome_autor}))
            .then(data_nasc => this.setState(dateFormat(data_nasc, "isoDate")))
            .catch(error => error.message);

        evento.target.reset();
    }

    render() {
        return(
            <form className="form-action" onSubmit={this.enviaDados.bind(this)}>
                <div className="input-form-action">
                    <label htmlFor="nomeAutor">Nome</label>
                    <input type="text" name="nomeAutor" required ref={(input) => this.nome_autor = input}/>
                </div>
            
                <div className="input-form-action">
                    <label htmlFor="dataNasc">Data de Nascimento</label>
                    <input type="date" name="dataNasc" placeholder="DD/MM/AAAA" pattern="\d{2}\/\d{2}/\d{4}" required ref={(input) => this.data_nasc = input}/>
                </div>
                <button type="submit" className="botao-form-action">Enviar</button>
            </form>
       )
    }
}