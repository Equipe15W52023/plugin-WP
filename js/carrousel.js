let articleIndex = 1;

function carrouselArticles(n) {
    let i;
    let articles = document.getElementsByClassName("projet_article");

    if (n > articles.length) {
        articleIndex = 1;
    }

    if (n < 1) {
        articleIndex = articles.length;
    }

    for (i = 0; i < articles.length; i++) {
        articles[i].style.display = "none";
    }

    articles[articleIndex - 1].style.display = "block";
}

function plusArticles(n) {
    carrouselArticles(articleIndex += n);
}

function animationArticles() {
    intervalId = setInterval(function () {
        plusArticles(1);
    }, 5000);
}

document.addEventListener('DOMContentLoaded', function () {
    carrouselArticles(articleIndex);
    animationArticles();
});