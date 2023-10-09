============================================================================================================================================
============================================================================================================================================

# TODO:

- [x] Controllare generazione chiave privata e chiave pubblica.
- [ ] Controllare riferimento alla variabile globale $wpdb.
- [ ] Salvare chiave privata nel DB
- [ ] Modificare funzione che crea DB all'attivazione del plugin, modificare le seguenti tabelle-colonne:
    - `...feeds -> time_to_upd` NULL DEFAULT '86400'
    - `...feeds -> pe_to_show` NULL DEFAULT '5'
    - `...feeds -> feed_style` NULL DEFAULT '1'
    - `...feeds -> pub_key` NULL DEFAULT 'NULL'
    - `...feeds -> priv_key` NULL DEFAULT 'NULL'
    - `...feeds -> token_fb` NULL DEFAULT 'NULL'