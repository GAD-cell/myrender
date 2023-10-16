# myrender
Application permettant de faire des collections de rendus 3D (type pinterest/behance).
La nomenclature a été un peu mal faite au début. Les entités Rendus sont des albums de Rendus 3D. Monrendu (que j'aurai dû écrire MonRendu) est l'objet des albums. Ce sont des rendus 3D.

Entités du modèle :
    
    
    Rendus { 
        Nom propriété : description
            Type : string
            Contraintes : notull
        
        Relations : ManyToOne avec Membre
                    OneToMany avec MonRendu
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

    Membre {
        Nom propriété : description
            Type : string
            Contraintes : null

        Nom propriété : actif_depuis
            Type : integer
            Contraintes : notnull
            commentaire : année d'inscription du membre
        
        Relation  OneToMany avec Rendus
    }