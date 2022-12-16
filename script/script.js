const mdp1 = document.getElementById('mdpPremier');
const mdp2 = document.getElementById('mdpConfirme');

let monmdp
let verif

mdp1.addEventListener('input', () => {
    //console.log(mdp1.value)
    monmdp = mdp1.value
    
});

mdp2.addEventListener('input', () => {
    //console.log(mdp2.value)
    verif = mdp2.value
})

console.log(monmdp);
console.log(verif)
if(monmdp != verif)
{
    alert("oooooooooooooo")
}
