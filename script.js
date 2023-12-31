var currentPage = 1;
var itemsPerPage = determineItemsPerPage();

window.addEventListener('resize', function () {
    itemsPerPage = determineItemsPerPage();
    displayItems();
});

function determineItemsPerPage() {
    return window.innerWidth <= 450 ? 4 : 3;
}

function displayItems() {
    var table = document.getElementById("characterTable");
    var rows = table.getElementsByTagName("tr");

    var startIndex = (currentPage - 1) * itemsPerPage + 1;
    var endIndex = startIndex + itemsPerPage;

    for (var i = 1; i < rows.length; i++) {
        rows[i].style.display = "none";
    }

    for (var i = startIndex; i < endIndex && i < rows.length; i++) {
        rows[i].style.display = "";
    }

    updatePaginationLinks();
}

function updatePaginationLinks() {
    var table = document.getElementById("characterTable");
    var rows = table.getElementsByTagName("tr");
    var totalPages = Math.ceil((rows.length - 1) / itemsPerPage);

    var paginationContainer = document.querySelector(".container-paginacao");
    paginationContainer.innerHTML = "";

    for (var i = 1; i <= totalPages; i++) {
        var pageLink = document.createElement("a");
        pageLink.href = "#";
        pageLink.textContent = i;

        if (i === currentPage) {
            pageLink.classList.add("active");
        }

        pageLink.addEventListener("click", function (event) {
            event.preventDefault();

            var links = paginationContainer.querySelectorAll("a");
            links.forEach(function (link) {
                link.classList.remove("active");
            });

            this.classList.add("active");

            currentPage = parseInt(this.textContent);
            displayItems();
        });

        paginationContainer.appendChild(pageLink);
    }
}

updatePaginationLinks();


// Função para ir para a próxima página
function nextPage() {
   var table = document.getElementById("characterTable");
   var rows = table.getElementsByTagName("tr");

   // Calcula o número total de páginas
   var totalPages = Math.ceil((rows.length - 1) / itemsPerPage);

   // Atualiza a página atual se não estiver na última página
   if (currentPage < totalPages) {
      currentPage++;
      displayItems();
   }
}

function prevPage() {
   
   if (currentPage > 1) {
      currentPage--;
      displayItems();
   }
}

function filtrarPersonagens() {
    // Obtém o valor digitado no input
    var nomePersonagem = document.getElementById("nomePersonagem").value.toLowerCase();

    
    var linhas = document.querySelectorAll("#characterTable tbody tr");

    // Verifica se o campo de busca está vazio
    if (nomePersonagem === "") {
        
        displayItems();
    } else {
        
        for (var i = 0; i < linhas.length; i++) {
            var nomePersonagemNaTabela = linhas[i].querySelector(".nome-heroi");
            if (nomePersonagemNaTabela) {
                nomePersonagemNaTabela = nomePersonagemNaTabela.textContent.toLowerCase();

                if (nomePersonagemNaTabela.includes(nomePersonagem)) {
                    linhas[i].style.display = "";
                } else {
                    linhas[i].style.display = "none";
                }
            }
        }
    }
}

//Redirecionar para a página de detalhes do personagem
function redirectToDetails(characterId) {
    window.location.href = 'detalhes.php?id=' + characterId;
}

// Exibe os itens da página inicial ao carregar a página
displayItems();