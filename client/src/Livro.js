import React, { Component } from 'react';
import dateFormat from 'dateformat';
import './css/main.css';

export default class Livro extends Component {

    constructor() {
        super();
        this.state = {nome_livro: '', isbn: '', data_criacao: '', num_paginas: ''};
    }

    enviaDadosLivro(evento) {
        evento.preventDefault();

        const requestInfo = {
            method: 'POST',
            body: JSON.stringify({nome_livro:this.nome_livro.value, isbn:this.isbn.value, data_criacao:this.data_criacao.value, num_paginas:this.num_paginas.value})
        }

        fetch('http://localhost:8000/livro/create.php', requestInfo)
            .then(response => {
                if(response.ok) {
                    return response.json();
                } else {
                    throw new Error("Não foi possível enviar os dados.");
                }
            })
            .then(nome_livro => this.setState({nome_livro:nome_livro}))
            .then(isbn => {
                if(isbn.length < 13) {
                    alert("ISBN inválido");
                } else {
                    this.setState({isbn:isbn})
                }
            })
            .then(data_criacao => this.setState(dateFormat(data_criacao)))
            .then(num_paginas => this.setState({num_paginas:num_paginas}))
            .catch(error => error.message)

        evento.target.reset();
    }

    render() {
        return(
            <form className="form-action" onSubmit={this.enviaDadosLivro.bind(this)}>
                <div className="input-form-action">
                    <label htmlFor="nomeLivro">Nome</label>
                    <input type="text" name="nomeLivro" required ref={(input) => this.nome_livro = input}/>
                </div>
            
                <div className="input-form-action">
                    <label htmlFor="isbn">ISBN</label>
                    <input type="text" name="isbn" required ref={(input) => this.isbn = input}/>
                </div>
            
                <div className="input-form-action">
                    <label htmlFor="dataCriacao">Data de Criação</label>
                    <input type="date" name="dataCriacao" required ref={(input) => this.data_criacao = input}/>
                </div>
            
                <div className="input-form-action">
                    <label htmlFor="numeroPaginas">Número de Páginas</label>
                    <input type="text" name="numeroPaginas" required ref={(input) => this.num_paginas = input}/>
                </div>
            
                <button className="botao-form-action">Enviar</button>
            </form>
       )
    }
}