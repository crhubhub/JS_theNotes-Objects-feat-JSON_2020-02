<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JS-OBJ _ htmlNotes by Clovis Reuss _ 2021-02</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<main>
    <h1>Notes by <em>CLO</em></h1>
    <div id="the-notes"></div>
</main>
<script>
    let notesArray = [];
    let htmlNotes = '';
    /*
    * Doing the Classes
    */
    const colorsAllowedArray = ['vert', 'jaune', 'orange', 'rouge'];

    class AbstractNote {
        constructor(title, importanceColor, creationDate, alertDate) {
            //affinee les vérifs ?
            if (typeof title === 'string' && (typeof colorsAllowedArray.indexOf(title) === "number") && typeof creationDate === 'string') {
                this._title = title;
                this._creationDate = creationDate;
                this._importanceColor = importanceColor;
                alertDate ? this._alertDate = alertDate : this._alertDate = undefined;

                // delete ci-dessous si ternaire ok...

                // if (!alertDate) {
                //     this._alertDate = undefined;
                // } else {
                //     this._alertDate = alertDate;
                // }
            }
        }

        // Getters
        get title() {
            return this._title;
        }

        get importanceColor() {
            return this._importanceColor;
        }

        get creationDate() {
            return this._creationDate;
        }

        get alertDate() {
            return this._alertDate;
        }

        // Setters
        set title(value) {
            this._title = value;
        }

        set importanceColor(value) {
            this._importanceColor = value;
        }

        set creationDate(value) {
            this._creationDate = value;
        }

        set alertDate(value) {
            this._alertDate = value;
        }
    }

    class Reminder extends AbstractNote {
        function

        render() {
            htmlNotes += 'salut, je suis un mémo';
            console.log(this.title);

        }

        constructor(title, importanceColor, creationDate, content) {
            super(title, importanceColor, creationDate);
            this._contentText = content;
        }


    }

    class ToDoList extends AbstractNote {
        function

        render() {
            htmlNotes += 'salut, je suis une liste';
        }

        constructor(title, importanceColor, creationDate, content, toDoCheckArray) {
            super(title, importanceColor, creationDate);
            this._toDoArray = content;
            this._toDoCheckArray = toDoCheckArray;
        }

    }

    /*
    * Parsing the JSON ... & ... creating objects
     */
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "notes.json");
    xhr.send();
    let parsedNotes;
    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            parsedNotes = JSON.parse(xhr.responseText).notes;
            // tri par date desc, pas nécessaire
            // parsedNotes.sort(function (a, b) {
            //     if (a.creationDate < b.creationDate) return 1;
            //     if (a.creationDate > b.creationDate) return -1;
            // })
            for (let i = 0; i < parsedNotes.length; i++) {
                let obj;
                if (parsedNotes[i].content instanceof Array) {
                    console.log('todolist à faire')
                    obj = new ToDoList(parsedNotes[i].title, parsedNotes[i].importanceColor, parsedNotes[i].creationDate, parsedNotes[i].content, parsedNotes[i].contentChecked);
                } else {
                    console.log('note à faire')
                    obj = new Reminder(parsedNotes[i].title, parsedNotes[i].importanceColor, parsedNotes[i].creationDate, parsedNotes[i].content);
                    obj.render();
                }
                // notesArray.push(obj);
                notesArray.unshift(obj);
            }
            for (let i=0; i<notesArray.length; i++) {
                console.log('affichage d\'un objet')
            }
        }
    }


    // console.info('displaying the objects...');


</script>
</body>
</html>