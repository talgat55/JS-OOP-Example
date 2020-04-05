class Book {
    constructor(title, text){
        this.title = title;
        this.text = text;
    }

    toShow(){
        console.log( `example  name book ${this.title}  with text   ${this.text} `);
    }
}

var newBook = new Book('Harry Potter', 'text');

console.log(newBook.toShow());