@extends('layouts.main')

@section('container')
    <h1 class="mb-3 text-center">{{ $title }}</h1>

    <style>
        .columns {
            display: flex;
            justify-content: space-around;
        }
    </style>
    <div class="columns">
        <ul id="pokemonList">
            <h2>Pokemon</h2>
        </ul>

        <div id="detail">
            <h2>Detail</h2>
        </div>
    </div>

    <script>
        //OnLoad
        //fetch All Pokemons
        fetch('https://pokeapi.co/api/v2/pokemon')
            .then(
                function(response) {
                    if (response.status != 200) {
                        console.log('Ooops...' + response.status)
                        return
                    }

                    response.json().then(function(data) {
                        const pokemons = data.results
                        pokemons.forEach(pokemon => {
                            document.getElementById('pokemonList')
                                .insertAdjacentHTML('beforeend',
                                    `<li onclick='detail("${pokemon.url}")'> ${pokemon.name} </li>`
                                )
                        })
                    })
                }
            )
            .catch(function(err) {
                console.log(err)
            })

        function detail(url) {
            fetch(url).then(function(response) {
                response.json().then(function(pokemon) {
                    document.getElementById('detail').innerHTML = ''
                    document.getElementById('detail')
                        .insertAdjacentHTML('beforeend',
                            `<h3> ${pokemon.name} </h3>
                <img src='${pokemon.sprites.front_default}'>
                <p>jurus:  ${pokemon.moves[0].move.name} </p>
                <p>Tinggi:  ${pokemon.height} </p>
                <p>Berat:  ${pokemon.weight} </p>
                `
                        )
                })
            })
        }
    </script>
@endsection
