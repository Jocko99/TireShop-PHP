$(document).ready(function(){
    scroll();
    navSlide();
    dodajUkorpu();
    $(".zatvori").click(zatvori);
    var strana = window.location.href;
    if(strana.indexOf("index.php")!==-1){
        //navigacija
        $("#posalji").on("click",pretrazi);
        // gumeProizvodi();
    }else if(strana.indexOf("gume.php")!==-1){

    }else if(strana.indexOf("login.php")!==-1){
        $("#lgReg").click(function(){
            location.href="registracija.php";
        })
    }else if(strana.indexOf("registracija.php")!==-1){
        $("#btnReg").on("click",regexProvera);
    }else if(strana.indexOf("admin.php")!==-1){
        $("#dodaj").on("click",dodajKorisnika)
        $("#izmeni").on("click",izmeniKorisnika);
        prikazKorisnika();
        $("#dodajGumu").on("click",dodajProizvod);
        prikaziGume();
        $("#izmeniGumu").on("click",izmeniProizvodGume);
        
    }else if(strana.indexOf("kontakt.php")!==-1){
        $("#btnKontakt").on("click",kontaktAdmin);
    }else if(strana.indexOf("korpa.php")!==-1){
        let proizvodi = proizvodiUKorpi();
        if(proizvodi.length){
            korpa()
            $("#kupi").show();
        }else{
            praznaKorpa();
        }
    }

    
})

function pretrazi(){
    let sirina,visina,precnik,sezona,proizvodjac,greske;
    sirina = $("#sirina").val();
    visina = $("#visina").val();
    precnik = $("#precnik").val();
    sezona = $("#sezona").val();
    proizvodjac = $("#proizvodjac").val();
    greske=[];       
    if(sirina == "0"){
        greske.push("Izaberite sirinu!");
    }
    if(visina == "0"){
        greske.push("Izaberite visinu!");
    }
    if(precnik == "0"){
        greske.push("Izaberite precnik!");
    }
    if(sezona == "0"){
        greske.push("Izaberite sezonu!");
    }
    if(proizvodjac == "0"){
        greske.push("Izaberite proizvodjaca!");
    }

    if(greske.length){
        
        let divGreske = `<ul class="bg-danger text-center font-weight-bold rounded-lg">`;
        for(let i=0;i<greske.length;i++){
            divGreske +=`<li>${greske[i]}<li>`
        }
        
            $("#searchGreske").html(divGreske);
    }else{
        $("#searchGreske").hide();
        $.ajax({
            url:"logic/pretraga.php",
            method:"GET",
            dataType:"json",
            data:{
                "sirina":sirina,
                "visina":visina,
                "precnik":precnik,
                "sezona":sezona,
                "proizvodjac":proizvodjac,
                "btnSearch":true
            },
            success:function(data,status,jqXHR){
                if(jqXHR.status == 200){
                var rezultatPr = $("#rezultatPretrage");
                pretragaRezultat(data,rezultatPr);
                }

                
                
            },
            error:function(xhr,error,status){
                if(xhr.status == 404){
                    $("#greske").removeClass("hide");
                }
            }
            
        })
    }
}
//PROIZVODI NA POCETNOJ STRANICI,PRETRAGA
function pretragaRezultat(rez,div){
    let ispis = "";
    rez.forEach(p => {
        ispis +=`<div class='col-lg-4 col-md-6 col-sm-6 rounded-lg m-auto'>
        <div class='item-logo'>
            <img src="${p.SlikaProizvodjaca}" alt="${p.Naziv}"/>
        </div>
        <div class="product-item">
            <img src="${p.Slika}" alt="${p.Opis}"/>
        </div>
        <div class="item-title text-center">
            <h3>${p.Naziv}</h3>
            <p>${p.Opis}`
            if(p.Sezona == "leto"){
               ispis +=`<span><i class='fas fa-sun text-warning'></i></span>`;
            }else{
               ispis +=`<span><i class="fas fa-snowflake text-white"></i></span>`;
            }
            ispis +=`
            </p>
        </div>
        <div class="item-desc text-center">
        <h4>${p.Sirina}/${p.Visina} R${p.Precnik}</h4>
        <div class='d-flex justify-content-center'>
        <p class='text-success font-weight-bold h4'>${p.Cena} din</p>
        </div>
        <a href='#'><button class='mb-3 dodajUkorpu' data-id="${p.ID}"><i class="fas fa-shopping-cart pr-1"></i>Dodaj u korpu</button></a>
        </div>
    </div>`
    })
    return div.html(ispis);
    
}

// function gumeProizvodi(){
//     $.ajax({
//         url:"logic/products.php",
//         method:"GET",
//         dataType:"json",
//         success:function(data,status,jqXHR){
//             if(jqXHR.status==200){
//                 var rezultatPr = $("#rezultatPretrage");
//                 pretragaRezultat(data,rezultatPr);
//             }

            
//         },
//         error:function(xhr,error,status){
//             console.log(xhr);
//         }
//     })
// }

    



function regexProvera(){
    let ime,prezime,email,lozinka,lozinkaPonovo,regexImePrezime,regexEmail,regexLozinka,greske;
    ime = $("#ime").val();
    prezime = $("#prezime").val();
    email = $("#email").val();
    lozinka = $("#pass").val();
    lozinkaPonovo = $("#passPonovo").val();
    greske = [];
    //regexi
    regexImePrezime = /^([A-ZŽĐŠ][a-zčćžšđ]{2,15}\s*)+$/;
    regexEmail = /^[\w\d\.]+@([a-z\.])+\.[a-z]{2,5}$/;
    regexLozinka = /^.{6,50}$/;
    //provera
    if(!regexImePrezime.test(ime)){
        $("#imeInfo").removeClass("hide");
        greske.push("Ime mora početi velikim slovom.");
    }else{
        $("#imeInfo").addClass("hide");
    }
    if(!regexImePrezime.test(prezime)){
        $("#prezimeInfo").removeClass("hide");
        greske.push("Prezime mora početi velikim slovom.");
    }else{
        $("#prezimeInfo").addClass("hide");
    }
    if(!regexEmail.test(email)){
        $("#emailInfo").removeClass("hide");
        greske.push("Email mora biti u formatu primer@gmail.com.")
    }else{
        $("#emailInfo").addClass("hide");
    }
    if(!regexLozinka.test(lozinka)){
        $("#lozinkaInfo").removeClass("hide");
        greske.push("Lozinka mora sadržati najmanje 6 karaktera.");
    }else{
        $("#lozinkaInfo").addClass("hide");
    }
    if(lozinka != lozinkaPonovo){
        $("#lozinkaPInfo").removeClass("hide");
        greske.push("Lozinke moraju biti iste.");
    }else{
        $("#lozinkaPInfo").addClass("hide");
    }

    if(!greske.count){
        $.ajax({
            url:"logic/register.php",
            method:"POST",
            dataType:"json",
            data:{
                "ime":ime,
                "prezime":prezime,
                "email":email,
                "pass":lozinka,
                "passPonovo":lozinkaPonovo,
                "btnRegister":true
            },
            success:function(data,status,jqXHR){
                if(jqXHR.status == 201){
                    location.href="login.php";
                }
            },
            error:function(xhr,error,status){
            }
            
        })
    }
}

//Burger slide
function navSlide(){
    $("#sendvic").click(function(){
        $("#prikazi").find("ul").slideToggle();    
    })
}

function scroll(){
    $("#scrollToTop").click(function(){
    
        $("html").animate({
            scrollTop: 0
        }, 1000);
    });
    
    $("#scrollToTop").hide();
    
    $(window).scroll(function(){
        let top = $("html").offset().top;
        top = $(this)[0].scrollY;
        if(top > 500){
            $("#scrollToTop").show();
        } else {
            $("#scrollToTop").hide();
        }
    })
    }

//FUNKCIJA DODAJKORISNIKA,OMOGUCAVA ADMINU DA DODAJE KORISNIKE
function dodajKorisnika(){
            let ime,prezime,email,lozinka,uloga,status,divUloga,divStatus,greske,regexEmail,regexImePrezime,regexLozinka;
            ime = $("#insertIme").val();
            prezime = $("#insertPrezime").val();
            email = $("#insertEmail").val();
            lozinka = $("#insertLozinka").val();
            uloga = $("#insertUloga").val();
            status = $("#insertStatus").val();
            greske = [];
            regexImePrezime = /^([A-ZŽĐŠ][a-zčćžšđ]{2,15}\s*)+$/;
            regexEmail = /^[\w\d\.]+@([a-z\.])+\.[a-z]{2,5}$/;
            regexLozinka = /^.{6,50}$/;
            if(!regexImePrezime.test(ime)){
                greske.push("Ime mora početi velikim slovom!");
            }
            if(!regexImePrezime.test(prezime)){
                greske.push("Prezime mora početi velikim slovom!");
            }
            if(!regexLozinka.test(lozinka)){
                greske.push("Lozinka treba sadržati najmanje 6 karaktera!");
            }
            if(uloga == "0"){
                greske.push("Izaberite ulogu!");
            }
            if(status == "0"){
                greske.push("Izaberite status!");
            }
            if(greske.length){
                let divGreske = `<ul class="bg-danger text-center font-weight-bold rounded-lg">`;
                 for(let i=0;i<greske.length;i++){
                 divGreske +=`<li>${greske[i]}<li>`
                 }
                 $("#greske").html(divGreske);
            }else{
                $("#greske").hide();
                $.ajax({
                    url:"logic/insert.php",
                    method:"POST",
                    dataType:"json",
                    data:{
                        "ime":ime,
                        "prezime":prezime,
                        "email":email,
                        "lozinka":lozinka,
                        "uloga":uloga,
                        "status":status,
                        "btnUnos":true
                    },
                    success:function(data,status,jqXHR){
                        if(jqXHR.status == 200){
                            alert("Uspesno ste dodali korisnika!")
                            location.reload();
                        }
                    }
                })
            }
            
    }
//FUNKCIJA PRIKAZKORINSIKA,PRIKAZUJE SVE KORISNIKE NA ADMIN PANELU
function prikazKorisnika(){
            $.ajax({
                url:"logic/prikaz.php",
                method:"POST",
                dataType:"json",
                success:function(data,status,jqXHR){
                    if(jqXHR.status==200){
                        var divTr="";
                        data.forEach(p=>{
                            divTr +=`<tr>
                            <td>${p.ID}</td><td>${p.Ime}</td><td>${p.Prezime}</td><td>${p.Email}</td><td>${p.Uloga}</td><td>`
                            if(p.status == 1){
                                divTr +=`aktivan`;
                            }else{
                                divTr +=`neaktivan`;
                            } divTr +=`</td><td><input type='button' onClick="obrisi('${p.ID}')" value='Obriši' class="adminPanelUredi"/></td>
                            <td><input type='button' onClick="izmeni('${p.ID}')" value='Izmeni' class="adminPanelUredi"/></td>
                        </tr>`
                        })

                            
                            console.log(data);
                           $("#adminPrikazi").html(divTr);
                        //    updateTabelaKorisnik(data);
                    }
                },
                error:function(xhr,status,error){
                    if(xhr.status==404){
                        alert("Nema rezultata");
                    }
                    if(xhr.status==500){
                        alert("Problem,upit nije izvrsen");
                    }
                }
    })
}
//FUNKCIJA ZA BRISANJE KORISNIKA
function obrisi(id){
    let idKorisnika = id;
    $.ajax({
        url:"logic/obrisiKorisnika.php",
        method:"POST",
        dataType:"json",
        data:{
            "idKorisnika":idKorisnika
        },
        success:function(data,status,jqXHR){
            if(jqXHR.status == 204){
                alert("Uspešno obrisan korisnik");
                location.reload();
            }
        },
        error:function(xhr,status,error){
            if(xhr.status == 500){
                alert("Lose napisan upit za brisanje");
            }
        }
    })

}
//PROSLEDJIVANEJ ID KORISNIKA KOME TREBA DA SE AZURIRAJU PODACI
function izmeni(id){
    let korisnikId = id;
    $.ajax({
        url:"logic/prikazKorisnikaUpdate.php",
                method:"POST",
                dataType:"json",
                data:{
                    "idKorisnika":korisnikId,
                    "btnUpdate":true 
                },
                success:function(data,status,jqXHR){
                    if(jqXHR.status == 200){
                        $("#insertIme").val(data.ime);
                        $("#insertPrezime").val(data.prezime);
                        $("#insertEmail").val(data.email);
                        $("#insertUloga").val(data.uloga_id);
                        $("#insertStatus").val(data.status);
                        $("#hiddenId").val(data.idKorisnik);
                    }
                },
                error:function(xhr,status,error){
                    console.log(xhr);
                }
    })
}
//FUNKCIJA ZA UPDATE KORISNIKA
function izmeniKorisnika(){
    let ime,prezime,email,lozinka,uloga,status,greske,regexEmail,regexImePrezime,regexLozinka,hiddenID;
    hiddenID = $("#hiddenId").val();
    console.log(hiddenID);
    ime = $("#insertIme").val();
    prezime = $("#insertPrezime").val();
    email = $("#insertEmail").val();
    lozinka = $("#insertLozinka").val();
    uloga = $("#insertUloga").val();
    status = $("#insertStatus").val();
    greske = [];
    regexImePrezime = /^([A-ZŽĐŠ][a-zčćžšđ]{2,15}\s*)+$/;
    regexEmail = /^[\w\d\.]+@([a-z\.])+\.[a-z]{2,5}$/;
    regexLozinka = /^.{6,50}$/;
    if(!regexImePrezime.test(ime)){
        greske.push("GRESKA IME");
        return false;
    }
    if(!regexImePrezime.test(prezime)){
        greske.push("GRESKA Prezime");
        return false;
    }
    if(!regexLozinka.test(lozinka)){
        greske.push("GRESKA Lozinka");
        return false;
    }
    if(uloga == "0"){
        greske.push("IZABERITE ULOGU");
    }
    if(status == "0"){
        greske.push("IZABERITE STATUS!");
    }
    if(greske.length){
        let ispis="<ul>";
        greske.forEach(greska => {
            ispis+=`<li>${greska}</li>`;
                
        });
        ispis+="</ul>"
        document.getElementById("greske").innerHTML=ispis;
            return false;
    }else{
        $.ajax({
            url:"logic/izmeniKorisnika.php",
            method:"POST",
            dataType:"json",
            data:{
                "hiddenID":hiddenID,
                "updateIme":ime,
                "updatePrezime":prezime,
                "updateEmail":email,
                "updateLozinka":lozinka,
                "updateUloga":uloga,
                "updateStatus":status,
                "btnIzmeni":true
            },
            success:function(data,status,jqXHR){
                if(jqXHR.status == 204){
                    alert("Uspesno ste izmenili podatke o korisniku!")
                    location.reload();
                }
            },
            error:function(xhr){
                console.log(xhr);
            }
        })
    }
    
}


//ADMIN PANEL,DODAVANJE PROIZVODA
function dodajProizvod(){
    let nazivGume,opisGume,cenaGume,sirinaGume,visinaGume,precnikGume,sezonaGume,proizvodjacGume,greske,regexNaziv,regexOpis;
    nazivGume = $("#nazivGume").val().trim();
    opisGume = $("#opisGume").val();
    cenaGume = $("#cenaGume").val();
    sirinaGume = $("#sirinaGume").val();
    visinaGume = $("#visinaGume").val();
    precnikGume = $("#precnikGume").val();
    sezonaGume = $("#sezonaGume").val();
    proizvodjacGume = $("#proizvodjacGume").val();
    greske=[];  
    regexNaziv = /^[\w\s]{3,}$/;
    regexOpis = /^.{3,200}$/;
    if(!regexNaziv.test(nazivGume)){
        greske.push("Unesite naziv!");
    }
    if(!regexOpis.test(opisGume)){
        greske.push("Unesite opis!");
    }
    if(cenaGume == "0"){
        greske.push("Unesite cenu!");
    }
    if(sirinaGume == "0"){
        greske.push("Izaberite sirinu!");
    }
    if(visinaGume == "0"){
        greske.push("Izaberite visinu!");
    }
    if(precnikGume == "0"){
        greske.push("Izaberite precnik!");
    }
    if(sezonaGume == "0"){
        greske.push("Izaberite sezonu!");
    }
    if(proizvodjacGume == "0"){
        greske.push("Izaberite proizvodjaca!");
    }

    if(greske.length){
        
        let divGreske = `<ul class="bg-danger text-center font-weight-bold rounded-lg">`;
        for(let i=0;i<greske.length;i++){
            divGreske +=`<li>${greske[i]}<li>`
        }
        
            $("#greskeUnosProizvodi").html(divGreske);
    }else{
        $("#greskeUnosProizvodi").hide();
        $.ajax({
            url:"logic/dodajProizvod.php",
            method:"POST",
            dataType:"json",
            data:{
                "nazivGume":nazivGume,
                "opisGume":opisGume,
                "cenaGume":cenaGume,
                "sirinaGume":sirinaGume,
                "visinaGume":visinaGume,
                "precnikGume":precnikGume,
                "sezonaGume":sezonaGume,
                "proizvodjacGume":proizvodjacGume,
                "btnAdd":true
            },
            success:function(data,status,jqXHR){
                if(jqXHR.status == 204){
                    alert("Uspešno dodat proizvod");
                    location.reload();
                }
                
            },
            error:function(xhr,error,status){
                console.log(xhr);
            }
            
        })
    }
}
//ADMIN PANEL,PRIKAZ SVIH PROIZVODA
function prikaziGume(){
    $.ajax({
        url:"logic/prikazProizvoda.php",
        method:"GET",
        dataType:"json",
        success:function(data,status,jqXHR){
            if(jqXHR.status==200){
                let html = `<table class="table">
                <thead>
                <tr>
                    <th>Fotografija</th>
                    <th>Naziv</th> 
                    <th>Cena</th>
                    <th>Obriši</th>
                    <th>Izmeni</th>
                </tr>
                </thead>
                <tbody>`
                data.forEach(p => {
                    html +=`<tr>
                    <td class="product-thumbnail">
                    <img src="${p.Slika}" alt="${p.Opis}" class="img-fluid imgKorpa">
                    </td>
                    <td class="product-name">
                    <h2 class="h5 text-black">${p.Opis}</h2>
                    </td>
                    <td>${p.Cena} din</td>
                    <td>
                        <input type="button" onClick="ukloniProizvod('${p.ID}')" value="Obriši" class="adminPanelUredi"/>
                    </td>
                    <td>
                        <input type="button" onClick="izmeniProizvod('${p.ID}')" value="Izmeni" class="adminPanelUredi"/>
                    </td>
                </tr>`
                })
                html +=` 
                </tbody>
            </table>`
        $("#prikaziGume").html(html);
            }

            
        },
        error:function(xhr,error,status){
            console.log(xhr);
        }
    })
}
function ukloniProizvod(id){
    let idProizvoda = id;
    $.ajax({
        url:"logic/obrisiProizvod.php",
        method:"POST",
        dataType:"json",
        data:{
            "idProizvoda":idProizvoda
        },
        success:function(data,status,jqXHR){
            if(jqXHR.status == 204){
                alert("Uspešno obrisan korisnik");
                location.reload();
            }
        },
        error:function(xhr,status,error){
            if(xhr.status == 500){
                alert("Loše napisan upit za brisanje");
            }
        }
    })
    
}
function izmeniProizvod(id){
    let idProizvoda = id;
    $("#nazivGume").focus();    
    $.ajax({
        url:"logic/prikazProizvodaUpdate.php",
                method:"POST",
                dataType:"json",
                data:{
                    "idProizvoda":idProizvoda,
                    "btnUpdate":true 
                },
                success:function(data,status,jqXHR){
                    if(jqXHR.status == 200){
                        $("#idGume").val(data.idProizvod)
                        $("#nazivGume").val(data.naziv)
                        $("#opisGume").val(data.opis);
                        $("#cenaGume").val(data.cena);
                        $("#sirinaGume").val(data.idSirina);
                        $("#visinaGume").val(data.idVisina);
                        $("#precnikGume").val(data.idPrecnik);
                        $("#sezonaGume").val(data.idSezona);
                        $("#proizvodjacGume").val(data.idProizvodjac);
                    }
                },
                error:function(xhr,status,error){
                    console.log(xhr);
                }
    })
}
function izmeniProizvodGume(){
    let nazivGume,opisGume,cenaGume,sirinaGume,visinaGume,precnikGume,sezonaGume,proizvodjacGume,greske,regexNaziv,regexOpis,hiddenID;
    hiddenID = $("#idGume").val();
    nazivGume = $("#nazivGume").val();
    opisGume = $("#opisGume").val();
    cenaGume = $("#cenaGume").val();
    sirinaGume = $("#sirinaGume").val();
    visinaGume = $("#visinaGume").val();
    precnikGume = $("#precnikGume").val();
    sezonaGume = $("#sezonaGume").val();
    proizvodjacGume = $("#proizvodjacGume").val();
    greske=[];  
    regexNaziv = /^[\w\s]{3,}$/;
    regexOpis = /^.{3,200}$/;
    if(!regexNaziv.test(nazivGume)){
        greske.push("Unesite naziv!");
    }
    if(!regexOpis.test(opisGume)){
        greske.push("Unesite opis!");
    }
    if(cenaGume == "0"){
        greske.push("Unesite cenu!");
    }
    if(sirinaGume == "0"){
        greske.push("Izaberite sirinu!");
    }
    if(visinaGume == "0"){
        greske.push("Izaberite visinu!");
    }
    if(precnikGume == "0"){
        greske.push("Izaberite precnik!");
    }
    if(sezonaGume == "0"){
        greske.push("Izaberite sezonu!");
    }
    if(proizvodjacGume == "0"){
        greske.push("Izaberite proizvodjaca!");
    }

    if(greske.length){
        
        let divGreske = `<ul class="bg-danger text-center font-weight-bold rounded-lg">`;
        for(let i=0;i<greske.length;i++){
            divGreske +=`<li>${greske[i]}<li>`
        }
        
            $("#greskeUnosProizvodi").html(divGreske);
    }else{
        $("#greskeUnosProizvodi").hide();
        $.ajax({
            url:"logic/izmeniProizvod.php",
            method:"POST",
            dataType:"json",
            data:{
                "hiddenID":hiddenID,
                "nazivGume":nazivGume,
                "opisGume":opisGume,
                "cenaGume":cenaGume,
                "sirinaGume":sirinaGume,
                "visinaGume":visinaGume,
                "precnikGume":precnikGume,
                "sezonaGume":sezonaGume,
                "proizvodjacGume":proizvodjacGume,
                "btnEdit":true
            },
            success:function(data,status,jqXHR){
                if(jqXHR.status == 204){
                    alert("Uspešno ažuriran proizvod");
                }
                
            },
            error:function(xhr,error,status){
                console.log(xhr);
            }
            
        })
    }
}



function korpa(){
        $.ajax({
            url:"logic/prikazProizvoda.php",
            method:"GET",
            dataType:"json",
            success:function(data,status,jqXHR){
                if(jqXHR.status == 200){
                    let products = proizvodiUKorpi();
                    let proizvodi = [];
                    proizvodi = data.filter(p => {
                    for(let pr of products)
                    {
                        if(p.ID == pr.id) {
                            p.kolicina = pr.kolicina;
                            return true;
                        }      
                    }
                    return false;
            });
            getTable(proizvodi);
                }
            },
            error:function(xhr){
                console.log(xhr);
            }
        }) 
}

function getTable(data){
    let html = `<table class="table table-bordered mt-3">
    <thead>
      <tr>
        <th class="product-thumbnail">Fotografija</th>
        <th class="product-thumbnail">Naziv</th> 
        <th class="product-thumbnail">Cena</th>
        <th class="product-thumbnail">Količina</th>
        <th class="product-thumbnail">Ukupno</th>
        <th class="product-thumbnail">Ukloni</th>
      </tr>
    </thead>
    <tbody>`
    data.forEach(p => {
        html +=`<tr>
        <td class="product-thumbnail">
          <img src="${p.Slika}" alt="${p.Opis}" class="img-fluid imgKorpa">
        </td>
        <td class="product-name">
          <h2 class="h5 text-black">${p.Naziv}</h2>
        </td>
        <td>${p.Cena} din</td>
        <td>
          <div class="input-group mb-3" style="max-width: 120px;">
            <div class="input-group-prepend">
              <button class="btn btn-outline-danger js-btn-minus" id="minus" type="button">−</button>
            </div>
            <input type="text" class="form-control text-center" value="4" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
            <div class="input-group-append">
              <button class="btn btn-outline-primary js-btn-plus" id="plus" type="button">+</button>
            </div>
          </div>

        </td>
        <td>${parseInt(p.Cena) * 4} din</td>
        <td><button class="btn btn-danger btn-sm" onclick='obrisiIzKorpe(${p.ID})'>X</button></td>
      </tr>`
    })
     html +=` 
    </tbody>
  </table>`
    $("#tabelaKorpe").html(html);
}

function proizvodiUKorpi() {
    return JSON.parse(localStorage.getItem("proizvodi"));
}

function dodajUkorpu() {
    $(".dodajUkorpu").click(function(e){
        e.preventDefault();
        let id = $(this).data("id");

    let proizvodi = proizvodiUKorpi();
    
    function dodajPrviProizvodUKorpu() {
        let proizvod = [];
        proizvod[0] = {
            id : id,
            kolicina : 1
        };
        localStorage.setItem("proizvodi", JSON.stringify(proizvod));
        $(".alert").removeClass("hide");
    }
    proizvodi ? daLiJeDodatoUKorpu() ? proizvodSeNalaziUKorpi() : dodajProizvod() : dodajPrviProizvodUKorpu();

    function proizvodSeNalaziUKorpi(){
        alert("Proizvod se nalazi u korpi,izaberite drugi.")
        $(".alert").addClass("hide").slideUp();
    }

    function daLiJeDodatoUKorpu() {
        return proizvodi.filter(p => p.id == id).length;
    }
    function dodajProizvod() {
        let proizvod = proizvodiUKorpi();
        proizvod.push({
            id : id,
            kolicina : 1
        });
        localStorage.setItem("proizvodi", JSON.stringify(proizvod));
        $(".alert").removeClass("hide");
    }
    
    });
}
function obrisiIzKorpe(id){
    let proizovdi = proizvodiUKorpi();
    let filtrirajProizvode = proizovdi.filter( function(x){
        if(x.id != id)
            return true;
    })

    localStorage.setItem("proizvodi", JSON.stringify(filtrirajProizvode));
    korpa();
}
function praznaKorpa(){
    let div = document.createElement("div");
    div.setAttribute("id","praznaKorpa")
    div.setAttribute("class","d-flex align-items-center justify-content-center ")
    let h = document.createElement("h1");
    div.append(h);
    let tekst = "Korpa je prazna";
    h.append(tekst);
    h.setAttribute("class","font-weight-light")
    $("#tabelaKorpe").html(div);
    $("#kupi").hide();
}
function zatvori(){
    return $(this).parent().addClass("hide");
}


function kontaktAdmin(){
    let ime,prezime,email,naslov,poruka,regexImePrezime,regexEmail,regexNaslov,regexPoruka,greske;
    ime = $("#kontaktIme").val().trim();
    prezime = $("#kontaktPrezime").val().trim();
    email = $("#kontaktEmail").val().trim();
    naslov = $("#kontaktNaslov").val().trim();
    poruka = $("#kontaktPoruka").val().trim();
    greske = [];
    //regexi
    regexImePrezime = /^([A-ZŽĐŠ][a-zčćžšđ]{2,15}\s*)+$/;
    regexEmail = /^[\w\d\.]+@([a-z\.])+\.[a-z]{2,5}$/;
    regexNaslov = /^[\w]{3,20}$/;
    regexPoruka = /^.{15,}$/;
    //provera
    if(!regexImePrezime.test(ime)){
        $("#kontaktImeInfo").removeClass("hide");
        greske.push(ime);
    }else{
        $("#kontaktImeInfo").addClass("hide");
    }
    if(!regexImePrezime.test(prezime)){
        $("#kontaktPrezimeInfo").removeClass("hide");
        greske.push(prezime);
    }else{
        $("#kontaktPrezimeInfo").addClass("hide");
    }
    if(!regexEmail.test(email)){
        $("#kontaktEmailInfo").removeClass("hide");
        greske.push(email);
    }else{
        $("#kontaktEmailInfo").addClass("hide");
    }
    if(!regexNaslov.test(naslov)){
        $("#kontaktNaslovInfo").removeClass("hide");
        greske.push(naslov);
    }else{
        $("#kontaktNaslovInfo").addClass("hide");
    }
    if(!regexPoruka.test(poruka)){
        $("#kontaktPorukaInfo").removeClass("hide");
        greske.push(poruka);
    }else{
        $("#kontaktPorukaInfo").addClass("hide");
    }

    if(!greske.length){
        alert("Poruka uspešno poslata!");
        location.reload();
    }
}


