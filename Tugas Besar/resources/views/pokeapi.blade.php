@extends('layouts/main')

@section('container')
    <style>
        body {
            background: rgb(85, 144, 189);
            background: linear-gradient(90deg,
                    rgba(85, 144, 189, 1) 0%,
                    rgba(108, 183, 240, 1) 54%,
                    rgba(182, 216, 242, 1) 82%);
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            font-family: "Oswald", sans-serif;
        }

        h1 {
            color: white;
        }

        .pokemon-container {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 30px;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 40px;
            margin-top: 20px;
        }

        .pokemon-block,
        .pokemon-block-back {
            border-radius: 10px;
            padding: 10px;
            background-color: white;
            box-shadow: 0 3px 15px rgba(100, 100, 100, 0.5);
        }

        .img-container {
            background-image: url("./blob.svg");
            background-repeat: no-repeat;
            background-position: center;
        }

        .pokemon-block p {
            margin: 5px;
        }

        .name {
            text-transform: capitalize;
            font-weight: bold;
            font-size: 1.2rem;
        }

        #spinner {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
        }

        .pagination {
            width: 90%;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 50px;
        }

        .card-container {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.8s;
            transform-style: preserve-3d;
        }

        .flip-card:hover .card-container {
            transform: rotateY(180deg);
        }

        .pokemon-block,
        .pokemon-block-back {
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
        }

        .pokemon-block-back {
            transform: rotateY(180deg);
            position: absolute;
            top: 0%;
        }

        .stat-container {
            display: grid;
            grid-template-columns: 1fr 2fr;
            text-align: left;
        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokedex</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&display=swap" rel="stylesheet">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    </head>

    <body>
        <h1 class="title">Pokedex</h1>
        <div class="pokemon-container">

        </div>
        <nav class="pagination" aria-label="...">
            <ul class="pagination">
                <li class="page-item" id="previous">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item" id="next">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
        <div id="spinner" class="spinner-border text-light" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <script>
            const pokemonContainer = document.querySelector(".pokemon-container");
            const spinner = document.querySelector("#spinner");
            const previous = document.querySelector("#previous");
            const next = document.querySelector("#next");

            let limit = 8;
            let offset = 1;

            previous.addEventListener("click", () => {
                if (offset != 1) {
                    offset -= 9;
                    removeChildNodes(pokemonContainer);
                    fetchPokemons(offset, limit);
                }
            });

            next.addEventListener("click", () => {
                offset += 9;
                removeChildNodes(pokemonContainer);
                fetchPokemons(offset, limit);
            });

            function fetchPokemon(id) {
                fetch(`https://pokeapi.co/api/v2/pokemon/${id}/`)
                    .then((res) => res.json())
                    .then((data) => {
                        createPokemon(data);
                        spinner.style.display = "none";
                    });
            }

            function fetchPokemons(offset, limit) {
                spinner.style.display = "block";
                for (let i = offset; i <= offset + limit; i++) {
                    fetchPokemon(i);
                }
            }

            function createPokemon(pokemon) {
                const flipCard = document.createElement("div");
                flipCard.classList.add("flip-card");

                const cardContainer = document.createElement("div");
                cardContainer.classList.add("card-container");

                flipCard.appendChild(cardContainer);

                const card = document.createElement("div");
                card.classList.add("pokemon-block");

                const spriteContainer = document.createElement("div");
                spriteContainer.classList.add("img-container");

                const sprite = document.createElement("img");
                sprite.src = pokemon.sprites.front_default;


                spriteContainer.appendChild(sprite);

                const sprite1 = document.createElement("img");
                sprite1.src = pokemon.sprites.back_default;


                spriteContainer.appendChild(sprite1);

                const number = document.createElement("p");
                number.textContent = `#${pokemon.id.toString().padStart(3, 0)}`;

                const name = document.createElement("p");
                name.classList.add("name");
                name.textContent = pokemon.name;


                card.appendChild(spriteContainer);
                card.appendChild(number);
                card.appendChild(name);

                const cardBack = document.createElement("div");
                cardBack.classList.add("pokemon-block-back");

                cardBack.appendChild(progressBars(pokemon.stats));

                cardContainer.appendChild(card);
                cardContainer.appendChild(cardBack);
                pokemonContainer.appendChild(flipCard);
            }

            function progressBars(stats) {
                const statsContainer = document.createElement("div");
                statsContainer.classList.add("stats-container");

                for (let i = 0; i < 3; i++) {
                    const stat = stats[i];

                    const statPercent = stat.base_stat / 2 + "%";
                    const statContainer = document.createElement("stat-container");
                    statContainer.classList.add("stat-container");

                    const statName = document.createElement("p");
                    statName.textContent = stat.stat.name;

                    const progress = document.createElement("div");
                    progress.classList.add("progress");

                    const progressBar = document.createElement("div");
                    progressBar.classList.add("progress-bar");
                    progressBar.setAttribute("aria-valuenow", stat.base_stat);
                    progressBar.setAttribute("aria-valuemin", 0);
                    progressBar.setAttribute("aria-valuemax", 200);
                    progressBar.style.width = statPercent;

                    progressBar.textContent = stat.base_stat;

                    progress.appendChild(progressBar);
                    statContainer.appendChild(statName);
                    statContainer.appendChild(progress);

                    statsContainer.appendChild(statContainer);
                }

                return statsContainer;
            }

            function removeChildNodes(parent) {
                while (parent.firstChild) {
                    parent.removeChild(parent.firstChild);
                }
            }

            fetchPokemons(offset, limit);
        </script>
    </body>
@endsection
