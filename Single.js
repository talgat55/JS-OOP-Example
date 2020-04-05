class News {
    constructor(title, text) {
        this.title = title;
        this.text = text;
        this.modified = false;

    }

    update(text) {
        this.text = text;
        this.modified = true;
    }
}

class NewsPrint {
    constructor(news){
        this.news = news;
    }
    html() {
        return ` 
            <div  class="new">
                <h1>${this.news.title}</h1>
                <p>${this.news.text}</p>
            </div>
        `;
    }


}

const news = new News('Тест 1', 'текст');

console.log(news.toHTML());