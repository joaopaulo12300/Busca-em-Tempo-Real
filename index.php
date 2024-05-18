<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca em Tempo Real</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        #results {
            border: 1px solid #ddd;
            max-height: 200px;
            overflow-y: auto;
            display: none;
        }
        .result-item {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .result-item:hover {
            background-color: #f0f0f0;
        }
        .no-results {
            padding: 10px;
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Busca em Tempo Real</h1>
    <input type="text" id="search" placeholder="Digite para buscar...">
    <div id="results"></div>

    <script>
        document.getElementById('search').addEventListener('input', function() {
            let query = this.value;
            if (query.length > 0) {
                fetch('busca.php?q=' + encodeURIComponent(query))
                    .then(response => response.json())
                    .then(data => {
                        let results = document.getElementById('results');
                        results.innerHTML = '';
                        if (data.length > 0) {
                            results.style.display = 'block';
                            data.forEach(item => {
                                let div = document.createElement('div');
                                div.classList.add('result-item');
                                div.textContent = item.nome;
                                results.appendChild(div);
                            });
                        } else {
                            results.style.display = 'block';
                            let noResultsDiv = document.createElement('div');
                            noResultsDiv.classList.add('no-results');
                            noResultsDiv.textContent = 'Item não encontrado';
                            results.appendChild(noResultsDiv);
                        }
                    });
            } else {
                document.getElementById('results').style.display = 'none';
            }
        });
    </script>
</body>
</html>
