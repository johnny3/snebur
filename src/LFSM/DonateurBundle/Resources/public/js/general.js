// variables globales
var fen;
var i = 0;
var j = 0;


var y_siren = 0;
var y_siret = 0;
var car = "";
var ok = 0;
var pgok = 1;


// Affichage du message dans la barre de status pour les onglets
// -------------------------------------------------------------
function showStatus(sMsg) {
    window.status = sMsg ;
    return true ;
}


// Ouverture du popup
// ------------------
function OuvrirPopup(Page, Nom, Option) {
    if ( Option == '' ) {
        Option = 'top=10, left=10, resizable=no, location=no, width=100, height=50, menubar=no, status=no, scrollbars=no, menubar=no';
    }
    if ( Nom == '' ) {
        Nom = 'LFSM';
    }        
    fen=window.open(Page, Nom, Option);
}

// Fermeture du popup
// ------------------
function FermerPopup() {
    if (fen.document) {
        fen.close();
    }
}

// fonction controle champs numerique
function ctrlnum(chp) {
    j = 0;
    ok = 0;
    for (i=0; i < chp.length; i++ ) {
        j = i + 1;
        car = chp.substring(i, j);
        if (car >= 0 && car <= 9 ) {
            ok = 1;
        } else {
            ok = 0;
            i = chp.length + 1;
        }
    }
    if (ok == 1 ) {
        pgok = 1;
    } else {
        document.gene.messerr.value = "Champ Numerique";
        pgok = 0;
    }
}

// fonction controle champs numerique avec virgule et 2 decimales
function ctrlmnt(chp) {
    j = 0;
    ok = 0;
    nb_vir = 0;
    nb_dec = 0;
    err = 0;
    pgok = 0;
    for (i=0; i < chp.length; i++ ) {
        j = i + 1;
        car = chp.substring(i, j);
        if (car == "." || car == ',') {
            nb_vir++;
            if (nb_vir > 1) {
                err = 1;
                i = chp.length + 1;
            }
        } else {
            if (car >= 0 && car <= 9 ) {
                err = 0;
                if (nb_vir > 0 ) {
                    nb_dec++;
                    if (nb_dec > 2) {
                        err = 3;
                        i = chp.length + 1;
                    }
                }
            } else {
                err = 2;
                i = chp.length + 1;
            }
        }
    }
    if (err == 0 ) {
        pgok = 1;
    }
    if (err == 1 ) {
        document.gene.messerr.value = "Trop de virgules";
    }
    if (err == 2 ) {
        document.gene.messerr.value = "Champ Numerique";
    }
    if (err == 2 ) {
        document.gene.messerr.value = "Trop de décimales";
    }
}

// fonction controle date deb <= fin les dates sont au format dd-mm-yyyy
function ctrldt(deb, fin) {
    var jour = deb.substring(0,2);
    var mois = deb.substring(3,5);
    var annee = deb.substring(6,10);
    deb = annee+mois+jour;
    jour = fin.substring(0,2);
    mois = fin.substring(3,5);
    annee = fin.substring(6,10);
    fin = annee+mois+jour;
    if (deb > fin) {
        pgok = 0;
        document.gene.messerr.value = "La date de début doit être <= à la date de fin"; 
    } else { 
        pgok = 1;
    }
}


// fonction pour aller a la page ctc
// ----------------------------------
function GoCtc() {
    if (document.gene.p_id.value == "") {
        document.gene.p_id.value = 0;
    }
    window.location.href = 'ctc_main.php?p_id='+document.gene.p_id.value;
}


// fonction pour aller a une page
// ------------------------------
function GoPg(pg) {
    window.location.href = pg;
}
    
// fonction pour ouvrir une fenetre popup grande
// ---------------------------------------------
function GoWin(pg) {
    var Opt = 'top=10, left=10, resizable=yes, location=no, width=1024, height=800, menubar=yes, status=no, scrollbars=yes';
    OuvrirPopup(pg, 'LFSM', Opt)
}

// fonction pour ouvrir une fenetre popup petite
// ---------------------------------------------
function GoPopup(pg) {
    var Opt = 'top=50, left=200, resizable=no, location=no, width=500, height=100, menubar=no, status=no, scrollbars=no';
    OuvrirPopup(pg, 'LFSM', Opt)
}

// fonction pour ouvrir l'aide
// ----------------------------
function GoAide() {
    var Opt = 'top=10, left=10, resizable=no, location=no, width=1024, height=600, menubar=no, status=no, scrollbars=no, menubar=no';
    OuvrirPopup('aide/index_aide.htm', 'Aide', Opt)
}
