
	


// 
// 
// ███████╗██████╗ ███████╗████████╗██████╗  ██████╗  █████╗ ██████╗ ██████╗     ██╗      ██████╗  ██████╗ ██╗ ██████╗
// ██╔════╝██╔══██╗██╔════╝╚══██╔══╝██╔══██╗██╔═══██╗██╔══██╗██╔══██╗██╔══██╗    ██║     ██╔═══██╗██╔════╝ ██║██╔════╝
// █████╗  ██████╔╝█████╗     ██║   ██████╔╝██║   ██║███████║██████╔╝██║  ██║    ██║     ██║   ██║██║  ███╗██║██║     
// ██╔══╝  ██╔══██╗██╔══╝     ██║   ██╔══██╗██║   ██║██╔══██║██╔══██╗██║  ██║    ██║     ██║   ██║██║   ██║██║██║     
// ██║     ██║  ██║███████╗   ██║   ██████╔╝╚██████╔╝██║  ██║██║  ██║██████╔╝    ███████╗╚██████╔╝╚██████╔╝██║╚██████╗
// ╚═╝     ╚═╝  ╚═╝╚══════╝   ╚═╝   ╚═════╝  ╚═════╝ ╚═╝  ╚═╝╚═╝  ╚═╝╚═════╝     ╚══════╝ ╚═════╝  ╚═════╝ ╚═╝ ╚═════╝
//                                                                                                             

//Donner le nom de l'intervalle à partir du nombre de demi-tons
function fbLogic_getTextFromInterval(interval) {
    switch (interval) {
        case 1  :
            intervalName = "2m";
            break;
        case 2  :
            intervalName = "2M";
            break;
        case 3  :
            intervalName = "3m";
            break;
        case 4  :
            intervalName = "3M";
            break;
        case 5  :
            intervalName = "4";
            break;
        case 6  :
            intervalName = "4D";
            break;
        case 7  :
            intervalName = "5";
            break;
        case 8  :
            intervalName = "6m";
            break;
        case 9  :
            intervalName = "6M";
            break;
        case 10 :
            intervalName = "7m";
            break;
        case 11 :
            intervalName = "7M";
            break;
        case 12 :
            intervalName = "8";
            break;
        default :
            intervalName = "T";
            break;
                    }
    return intervalName;
}

//Donner le nombre de demi-tons entre deux notes (format EN4,EB3,FD1...)
function fbLogic_getIntervalFromNotes(noteA, noteB){
    var ecart;
    var pitchEcart;
    var noteATune = noteA.substring(0, 2);
    var noteAPitch = noteA.substring(2, 3);
    var noteBTune = noteB.substring(0, 2);
    var noteBPitch = noteB.substring(2, 3);
    pitchEcart = parseInt(noteBPitch) - parseInt(noteAPitch);
    YnoteA = parseInt(notes.indexOf(noteATune));
    YnoteB = parseInt(notes.indexOf(noteBTune));
    if (YnoteB >= YnoteA)
        ecart = YnoteB - YnoteA;
    else {
        if (pitchEcart == 0)
            ecart = (12 - YnoteA) + YnoteB;
        //si pas de pitch d'�crat
        else
            ecart = YnoteB - YnoteA;
    }
    ecart = ecart + (12 * pitchEcart);
    return ecart;
}

//Trouver les notes jumelles sur le manche (renvoie un tableau de coordonnées)
function fbLogic_findTwinNotes(noteDesti) {
    var ecart;
    //noteDesti = "DN6";
    var pitchStarter;
    var pitchDesti;
    var twinNote;
    var twinNotes = new Array();
    for ( k = 0; k < stringStarters.length; k++) {
        pitchStarter = parseInt(stringStarters[k].substring(2, 3));
        pitchDesti = parseInt(noteDesti.substring(2, 3));
        //le pitch de la note est plus bas qu le pitch de la corde � vide, inutile d'aller plus loin
        if ((pitchStarter < pitchDesti) || ((pitchStarter == pitchDesti) && (notes.indexOf(noteDesti.substring(0, 2)) >= notes.indexOf(stringStarters[k].substring(0, 2))))) {
            //on prend l'�cart entre la note de la corde � vide et la note desti
            ecart = fbLogic_getIntervalFromNotes(stringStarters[k], noteDesti);
            //si l'�cart peut-�tre atteind dans l'intervalle du manche, on garde
            if (ecart >= 0 && ecart <= frtKnwLimitFr2) {
                twinNote = new Array();
                twinNote.X = ecart;
                twinNote.Y = k;
                twinNotes.push(twinNote);
            }
        }
    }
    if (!(twinNotes.length > 0)) {
        var f = 1;
    }
    return twinNotes;
}

//Créer le nom du fichier audio à partir d'une note de guitare + coordonnées
function fbLogic_buildGuitarFileName(xCoord, yCoord, note) {
    var yCoord2 = yCoord + 1;
    var xCoord2 = xCoord;
    if (xCoord < 10)
        xCoord2 = "0" + xCoord;
    if (accChoice == "B" || note.substring(1, 2) == "B")
        note = notesSharp[notesFlat.indexOf(note.substring(0, 2))] + note.substring(2, 3);

    return "ACN" + yCoord2 + xCoord2 + note;
    // + ".mp3";
}

//Retrouver la note correspondant à des coordonnées
function fbLogic_getNoteFromCoordinates(fretCoord, stringCoord) {
    if (accChoice == "B")
        notes = notesFlat;
    else
        notes = notesSharp;

    //Note (+pitch) de d�part
    var stringChosen = stringStarters[stringCoord];
    var finalNote = fbLogic_getNoteFromNote(stringChosen, fretCoord, 1);
    return finalNote;
}

//Récupérer la note cible à partir d'une note, d'un écart et d'un sens
function fbLogic_getNoteFromNote(startNote, ecart, sens) {
    if (sens == 2)
        ecart = 12 - ecart;

    if (accChoice == "B")
        notes = notesFlat;
    else
        notes = notesSharp;

    //Hauteur de d�part
    var pitchStart = parseInt(startNote.substring(2, 3));

    //Note de d�part
    var noteStart = startNote.substring(0, 2);
    // On fait +1 au pitch chaque fois qu'on fracnhit un octave (si �cart > 12)
    var increased = Math.floor(ecart / 12);
    // On prend l'�cart net entre les deux notes
    var reste = ecart - (12 * increased);

    //Index de la note de d�part dans le tableau des notes
    var indexofstart = notes.indexOf(noteStart);
    //
    var indexofstartPlusReste = indexofstart + reste;

    if (indexofstartPlusReste >= 12) {
        indexofstartPlusReste = indexofstartPlusReste - 12;
        increased++;
    }

    var noteFinal = notes[indexofstartPlusReste];
    var pitchFinal = pitchStart + increased;
    if (sens == 2)
        pitchFinal--;
    return noteFinal + pitchFinal + "";
}

//Note à afficher si EN, notes en C,D... si FR Do R�...
function fbLogic_displayableNote(completeNote) {
    var note = completeNote.substring(0, 1);
    if (displayNoteMethod == "fr") {
        switch (note) {
            case "C" :
                note = "Do";
                break;
            case "D" :
                note = "Ré";
                break;
            case "E" :
                note = "Mi";
                break;
            case "F" :
                note = "Fa";
                break;
            case "G" :
                note = "Sol";
                break;
            case "A" :
                note = "La";
                break;
            case "B" :
                note = "Si";
                break;
                    }
    }
    var accidentalSrc = completeNote.substring(1, 2);
    var accidentalDst = "";
    if (accidentalSrc == "D")
        accidentalDst = "#";
    if (accidentalSrc == "B")
        accidentalDst = "b";
    return note + accidentalDst;

}
//Note à afficher si EN, notes en C,D... si FR Do R�... avec accidentel adaptés HTML
function fbLogic_displayableNoteHTML(completeNote) {
    var note = completeNote.substring(0, 1);
    if (displayNoteMethod == "fr") {
        switch (note) {
            case "C" :
                note = "Do";
                break;
            case "D" :
                note = "Ré";
                break;
            case "E" :
                note = "Mi";
                break;
            case "F" :
                note = "Fa";
                break;
            case "G" :
                note = "Sol";
                break;
            case "A" :
                note = "La";
                break;
            case "B" :
                note = "Si";
                break;
                    }
    }
    var accidentalSrc = completeNote.substring(1, 2);
    var accidentalDst = "";
    if (accidentalSrc == "D")
        accidentalDst = "&#9839;";
    if (accidentalSrc == "B")
        accidentalDst = "&#9837;";
    return note + accidentalDst;

}



// █████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗
// ╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝
// ███████╗███████╗███████╗███████╗███████╗███████╗███████╗███████╗  
// ╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝  