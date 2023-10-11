============================================================================================================================================
============================================================================================================================================

# TODO:

- [x] Controllare generazione chiave privata e chiave pubblica.
- [X] Controllare riferimento alla variabile globale $wpdb.
- [X] Salvare chiave privata nel DB
- [X] Modificare funzione che crea DB all'attivazione del plugin, modificare le seguenti tabelle-colonne:
    - `...feeds -> time_to_upd` NULL DEFAULT '86400'
    - `...feeds -> pe_to_show` NULL DEFAULT '5'
    - `...feeds -> feed_style` NULL DEFAULT '1'
    - `...feeds -> pub_key` NULL DEFAULT 'NULL'
    - `...feeds -> priv_key` NULL DEFAULT 'NULL'
    - `...feeds -> token_fb` NULL DEFAULT 'NULL'

## Per il Database
- [ ] Creare una tabella `cache` che servirà per salvare i dati momentaneamente (es: i dati appena decryptati).
- [ ] Dopo aver creato la tabella, creare l'apposita classe che gestisce la cache.