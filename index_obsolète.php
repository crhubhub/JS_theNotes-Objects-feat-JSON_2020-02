<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>

<script>

    // objet décomposé en boucle for et écriture en html, 'global'
    let theNotesCompilationForHTML = '';

    // JSON loadind via xmlHttpRequest, then parsing en objet
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let notesObject = JSON.parse(xhttp.responseText).notes;
            // re-order by
            notesObject.sort(function (a, b) {
                if (a.creationDate < b.creationDate) return 1;
                if (a.creationDate > b.creationDate) return -1;
            })

            // transformation de l'objet en 'arrays' en réeles instanciations
            for (let i = 0; i < notesObject.length; i++) {
                let incrementalNaming = 'note'+i;
                console.log(incrementalNaming)
                if (notesObject[i].content[1].length > 1) {
                    oneJsNote = new ToDoList(notesObject[i].title, notesObject[i].importanceColor, notesObject[i].creationDate, notesObject[i].content, notesObject[i].contentChecked);
                } else {
                    oneJsNote = new Reminder(notesObject[i].title, notesObject[i].importanceColor, notesObject[i].creationDate, notesObject[i].content);
                }
                importednotesObject.push(oneJsNote);
                console.log('oneJsNote down here')
                console.log(oneJsNote)
                console.log(importednotesObject)
            }
        }
    }
    /*
    Je dois pouvoir déstocker et stocker dans notes.json  TODO later ...
    */

    /*
    * Création du Render de bloc qui utilise le render de chaque élément du tableau TODO
    */
    function displayNotes(thenotesObject, htmlDestination) {
        // console.log(thenotesObject.length);
        for (let i = 0; i < thenotesObject.length; i++) {
            console.log('test ici');
            // theHtmlCompilation += thenotesObject[i].render();
            console.log(thenotesObject.length);
            // console.log(thenotesObject}) //TODO créer des éléments HTML depuis un array  1                            //  TODO    ( et utiliser __noteReference pour le choix ensuite) 2
            theNotesCompilationForHTML += '<div> un élément HTML</div>';
        }
        theNotesCompilationForHTML = '</' + htmlDestination + '>';
        document.getElementById('the-notes').innerHTML += theNotesCompilationForHTML;
    }











    for (let i = 0; i < notesObject.length; i++) {
        htmlNotes += '<div class="one-note" style="border-radius: 0.6em; border: solid 3.5px ';
        switch (notesObject[i].importanceColor) {
            case 'red' :
                htmlNotes += 'red';
                break;
            case 'orange' :
                htmlNotes += 'orange';
                break;
            case 'yellow' :
                htmlNotes += 'yellow';
                break;
            case 'green' :
                htmlNotes += 'green';
                break;
            default :
                htmlNotes += 'lightGrey';
        }
        htmlNotes += '"> Titre : ' + notesObject[i].title + '<br>';

        if ((notesObject[i].alertDate != "null")) {
            htmlNotes += 'Échéance : ' + notesObject[i].alertDate + '<br>';
        } else {
            htmlNotes += '(pas de date de fin)<br>';
        }
        if (((notesObject[i].content[1].length) > 1)) {
            htmlNotes += '<ul></ul>'
            for (let n = 0; n < notesObject[i].content.length; n++) {
                htmlNotes += '<li>' + notesObject[i].content[n] + '</li>';

            }
            htmlNotes += '<br>LISTE créée le ';
        } else {
            htmlNotes += '<ul></ul><li>' + notesObject[i].content + '</li><br><br>MÉMO créé le ';
        }
        htmlNotes += notesObject[i].creationDate + '<br></div>'
    }











    document.getElementById('the-notes').innerHTML = '<div>bonjour</div>';
    // document.getElementById('the-notes').innerHTML = theNotesCompilationForHTML;
    // displayNotes([0, 1, 2], 'aside');
    displayNotes(importednotesObject, 'the-notes');
</script>
</body>
</html>