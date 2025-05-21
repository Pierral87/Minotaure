-- UNION permet de fusionner plusieurs résultats de requête en un seul
-- ATTENTION, le nombre de champs attendus doit être le même dans les requêtes concernées
-- UNION applique un DISTINCT par défaut pour ne pas avoir de doublons de résultat
SELECT prenom AS liste_de_personnes FROM abonne
UNION
SELECT auteur FROM livre;
+--------------------+
| Guillaume          |
| Benoit             |
| Chloe              |
| Laura              |
| Pierral            |
| GUY DE MAUPASSANT  |
| HONORE DE BALZAC   |
| ALPHONSE DAUDET    |
| ALEXANDRE DUMAS    |
+--------------------+

-- Pour avoir les doublons : 
-- UNION ALL 
SELECT prenom AS liste_de_personnes FROM abonne
UNION ALL
SELECT auteur FROM livre;
+--------------------+
| liste_de_personnes |
+--------------------+
| Guillaume          |
| Benoit             |
| Chloe              |
| Laura              |
| Pierral            |
| GUY DE MAUPASSANT  |
| GUY DE MAUPASSANT  |
| HONORE DE BALZAC   |
| ALPHONSE DAUDET    |
| ALEXANDRE DUMAS    |
| ALEXANDRE DUMAS    |
+--------------------+