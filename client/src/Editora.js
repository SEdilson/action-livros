import React, { Component } from 'react';
import dateFormat from 'dateformat';
import './css/main.css';

export default class Autor extends Component {

    constructor() {
        super();
        this.state = {nome_editora: '', data_fundacao: ''};
    }

    enviaDadosEditora(evento) {
        evento.preventDefault();

        const requestMethod = {
            method: 'POST',
            body: JSON.stringify({nome_editora:this.nome_editora.value, data_fundacao:this.data_fundacao.value})
        };

        fetch('http://localhost:8000/editora/create.php', requestMethod)
            .then(response => {
                if(response.ok) {
                    return response.json();
                } else {
                    throw new Error("Não foi possível enviar os dados.");
                }
            })
            .then(nome_editora => this.setState({nome_editora}))
            .then(data_fundacao => this.setState(dateFormat(data_fundacao, "isoDate")))
            .catch(error => error.message)

        evento.target.reset();
    }

    render() {
        return(
            <form className="form-action" onSubmit={this.enviaDadosEditora.bind(this)}>
                <div className="input-form-action">
                    <label htmlFor="nomeEditora">Nome</label>
                    <input type="text" name="nomeEditora" required ref={(input) => this.nome_editora = input}/>
                </div>
            
                <div className="input-form-action">
                    <label htmlFor="dataFundacao">Data de Fundação</label>
                    <input type="date" name="dataFundacao" required ref={(input) => this.data_fundacao = input}/>
                </div>
            
                <button className="botao-form-action">Enviar</button>
            </form>
       )
    }
}