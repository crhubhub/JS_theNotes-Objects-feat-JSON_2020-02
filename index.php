<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JS _ Obj::theNotes _ by Clovis Reuss _ 2020 02</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<main>
    <h1>Notes by <em>CLO</em></h1>
    <div id="the-notes">

    </div>
</main>
<script>
    let importedNotesArray = [];
    let theNotesCompilationForHTML = '';

    /*
    * JSON download & parsing in notesArray

     */
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let notesArray = JSON.parse(xhttp.responseText).notes;

            // Reclassement des notes par date (les + récentes d'abord)
            notesArray.sort(function (a, b) {
                if (a.creationDate < b.creationDate) return 1;
                if (a.creationDate > b.creationDate) return -1;
            })
            /*
            * Instanciation des notes en f° du contenu (si(tableau) : {} else)
            */

            for (let i = 0; i < notesArray.length; i++) {
                let importedNote;
                if (notesArray[i].content[1].length > 1) {
                    importedNote = new ToDoList(notesArray[i].title, notesArray[i].importanceColor, notesArray[i].creationDate, notesArray[i].content, notesArray[i].contentChecked);
                } else {
                    importedNote = new Reminder(notesArray[i].title, notesArray[i].importanceColor, notesArray[i].creationDate, notesArray[i].content);
                }
                importedNotesArray.push(importedNote);
            }
        }
    }
    /*
    Je dois pouvoir déstocker et stocker dans notes.json  TODO later ...
    */





















    // TODO

    /*
    * Création du Render de bloc qui utilise le render de chaque élément du tableau TODO
    */
    function notesHtmlRender(theNotesArray, htmlDestination) {
        let theHtmlCompilation = '<' + htmlDestination + '>';
        for (let i = 0; i < theNotesArray.length; i++) {
            // theHtmlCompilation += theNotesArray[i].render();
            console.log(theNotesArray.length);
            console.log('un élément') //TODO créer des éléments HTML depuis un array  1                            //  TODO    ( et utiliser __noteReference pour le choix ensuite) 2
            theHtmlCompilation += '<div> un élément HTML</div>';
        }
        theHtmlCompilation = '</' + htmlDestination + '>';
        document.getElementById(htmlDestination).innerHTML += theHtmlCompilation;
    }

    /*
    * Les Classes : ABSTRACT, mémo, liste
    * */
    const colorsAllowedArray = ['vert', 'jaune', 'orange', 'rouge'];

    class AbstractNote {
        // function displayNote(notesArrayToUse, htmlContainerType) { TODO pas compris l'utilité, le sens de cette fonction
        //     // importedNotesArray, aside
        //
        // };
        constructor(title, importanceColor, creationDate, alertDate) {
            console.log(this)
            if (typeof title === 'string' && (typeof colorsAllowedArray.indexOf(title) === "number") && typeof creationDate === 'string') {
                this._title = title;
                this._creationDate = creationDate;
                this._importanceColor = importanceColor;
                if (!alertDate) {
                    this._alertDate = undefined;
                } else {
                    this._alertDate = alertDate;
                }
            }
        }

        // GETTERS
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

        // SETTERS
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
            return this.title;
        }

        constructor(title, importanceColor, creationDate, content) {
            super(title, importanceColor, creationDate);
            this._contentText = content;
        }

        get contentText() {
            return this._contentText;
        }

        set contentText(value) {
            this._contentText = value;
        }
    }

    class ToDoList extends AbstractNote {
        function

        render() {
            return this.title;
        }

        constructor(title, importanceColor, creationDate, content, toDoCheckArray) {
            super(title, importanceColor, creationDate);
            this._toDoArray = content;
            this._toDoCheckArray = toDoCheckArray;
        }

        get toDoArray() {
            return this._toDoArray;
        }

        get toDoCheckArray() {
            return this._toDoCheckArray;
        }

        set toDoArray(value) {
            this._toDoArray = value;
        }

        set toDoCheckArray(value) {
            this._toDoCheckArray = value;
        }
    }


    // }
    //
    //         for (let i = 0; i < notesArray.length; i++) {
    //             theNotes += '<div class="one-note" style="border-radius: 0.6em; border: solid 3.5px ';
    //             switch (notesArray[i].importanceColor) {
    //                 case 'red' :
    //                     theNotes += 'red';
    //                     break;
    //                 case 'orange' :
    //                     theNotes += 'orange';
    //                     break;
    //                 case 'yellow' :
    //                     theNotes += 'yellow';
    //                     break;
    //                 case 'green' :
    //                     theNotes += 'green';
    //                     break;
    //                 default :
    //                     theNotes += 'lightGrey';
    //             }
    //             theNotes += '"> Titre : ' + notesArray[i].title + '<br>';
    //
    //             if ((notesArray[i].alertDate != "null")) {
    //                 theNotes += 'Échéance : ' + notesArray[i].alertDate + '<br>';
    //             } else {
    //                 theNotes += '(pas de date de fin)<br>';
    //             }
    //             if (((notesArray[i].content[1].length) > 1)) {
    //                 theNotes += '<ul></ul>'
    //                 for (let n = 0; n < notesArray[i].content.length; n++) {
    //                     theNotes += '<li>' + notesArray[i].content[n] + '</li>';
    //
    //                 }
    //                 theNotes += '<br>LISTE créée le ';
    //             } else {
    //                 theNotes += '<ul></ul><li>' + notesArray[i].content + '</li><br><br>MÉMO créé le ';
    //             }
    //             theNotes += notesArray[i].creationDate + '<br></div>'
    //         }

    // }
    /*
    * ANCIEN : injection de mes notes (sans util. des classes) vers le HTML TODO to del
    */

    /*
    * Ouverture et modification du JSON
     */
    xhttp.open("GET", "notes.json", true);
    xhttp.send();
    document.getElementById('the-notes').innerHTML = '<div>bonjour</div>';
    // document.getElementById('the-notes').innerHTML = theNotesCompilationForHTML;
    notesHtmlRender([0, 1, 2], 'aside');
</script>
</body>
</html>