function Course(title, instructor, level, published, views) {
    this.title=title;
    this.instructor=instructor;
    this.level=level;
    this.published=published;
    this.views=views;

    this.updateViews = function() {
        return ++this.views;
    };

}

//var course01 = new Course("Javascript Essential Training", "Morton Rand-Henrikson","0",true,"0");
//var course02 = new Course("Up and Running with EcmaScript6","John Doe","0",true,"1234");

//console.log(course01);
//console.log(course02);

var courses = [
    new Course("Javascript Essential Training", "Morton Rand-Henrikson","0",true,"0"),
    new Course("Up and Running with EcmaScript6","John Doe","0",true,"1234")
    
];

console.log(courses);
