function GetId(id)
{
    return document.getElementById(id);
}
var i=false; // La variable i nous dit si la bulle est visible ou non
 
function move(e) {
    if(i) {  // Si la bulle est visible, on calcul en temps reel sa position ideale
        if (navigator.appName!="Microsoft Internet Explorer") { // Si on est pas sous IE
            GetId("curseur").style.left=e.pageX + 5+"px";
            GetId("curseur").style.top=e.pageY + 10+"px";
        }
        else { // Modif proposÃƒÂ© par TeDeum, merci Ãƒ   lui
            if(document.documentElement.clientWidth>0) {
                GetId("curseur").style.left=20+event.x+document.documentElement.scrollLeft+"px";
                GetId("curseur").style.top=10+event.y+document.documentElement.scrollTop+"px";
            } else {
                GetId("curseur").style.left=20+event.x+document.body.scrollLeft+"px";
                GetId("curseur").style.top=10+event.y+document.body.scrollTop+"px";
            }
        }
    }
}
 
function montre(text) {
    if(i==false) {
        GetId("curseur").style.visibility="visible"; // Si il est cacher (la verif n'est qu'une securitÃƒÂ©) on le rend visible.
        GetId("curseur").innerHTML = text; // on copie notre texte dans l'ÃƒÂ©lÃƒÂ©ment html
        i=true;
    }
}
function cache() {
    if(i==true) {
        GetId("curseur").style.visibility="hidden"; // Si la bulle est visible on la cache
        i=false;
    }
}
document.onmousemove=move; // dÃƒÂ¨s que la souris bouge, on appelle la fonction move pour mettre Ãƒ  jour la position de la bulle.

