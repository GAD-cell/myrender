# myrender
Application permettant de faire des collections de rendus 3D (type pinterest/behance).

Entités du modèle :
    
    
    Rendus { 
        Nom propriété : description
            Type : string
            Contraintes : notull
    }

    Album  {
        Nom propriété : description
            Type : string
            Contraintes : notnull
            Commentaire : permet de faire une album de rendus au sein de l'inventaire (ex: album de rendus en noir et blanc)
            association de type many to many avec Mon rendu

    }   

    Monrendu {
        Nom propriété : description
            Type : string
            Contraintes : notnull

        Nom propriété : Logiciel
            Type : string
            Contraintes : notnull
        
        Nom propriété : Moteur de rendu
            Type : string
            Contraintes : notnull

        Nom propriété : 
            Type : string
            Contraintes : notnull        
    }