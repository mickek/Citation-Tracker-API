[[PageOutline]]

= PUBLICATIONS =

== LIST PUBLICATIONS ==
Authenticated client can ask for a list of all his publications.

=== Request ===

{{{GET /api/1.0/publications/list.json}}}

=== Response ===

Array of publication objects

==== Example response: ====
{{{
[
  {
    "google_scholar_id": ["http://scholar.google.com/scholar?cites=10552781417408431533&hl=en&num=100&as_sdt=2000"], 
    "isbn": "", 
    "urls_other": [], 
    "pub_type": "inproceedings", 
    "series": "", 
    "authors": ["Alpa Jain", "Panagiotis G. Ipeirotis", "AnHai Doan", "Luis Gravano"], 
    "number": "", 
    "edition": "", 
    "title": "Join Optimization of Information Extraction Output: Quality Matters!", 
    "booktitle": "ICDE", 
    "pages": "186-197", 
    "note": "", 
    "eprint": "", 
    "editor": "", 
    "howpublished": "", 
    "bibsource": "DBLP, http://dblp.uni-trier.de", 
    "type": "", 
    "urls_pdf": [], 
    "tags": [], 
    "journal": "", 
    "volume": "", 
    "address": "", 
    "annote": "", 
    "pub_date": "2009", 
    "institution": "", 
    "chapter": "", 
    "publisher": "", 
    "school": "", 
    "doi": "10.1109/ICDE.2009.138", 
    "urls_slides": [], "dblp": "conf/icde/JainIDG09", "citekey": "DBLP:conf/icde/JainIDG09", "notes": "", "venue": "Proceedings of the 25th International Conference on Data Engineering, ICDE 2009, March 29 2009 - April 2 2009, Shanghai, China", 
    "urls_bibtex": [], 
    "organization": ""
  }, 
{"google_scholar_id": ["http://scholar.google.com/scholar?cites=7177304227864115615&hl=en&num=100&as_sdt=2000"], "isbn": "", "urls_other": ["http://portal.acm.org/citation.cfm?id=1168054.1168073", "http://citeseerx.ist.psu.edu/viewdoc/download?doi=10.1.1.108.5849&rep=rep1&type.pdf"], "pub_type": "", "series": "", "authors": ["M <b>Cielecki</b>", "J Fulara", "K Jakubczyk", "\u0141  &hellip; "], "number": "", "edition": "", "title": "Propagation of JML non-null annotations in Java programs", "booktitle": "", "pages": "", "note": "", "eprint": "", "editor": "", "howpublished": "", "bibsource": "", "type": "", "urls_pdf": [], "tags": [], "journal": "", "volume": "", "address": "", "annote": "", "pub_date": "", "institution": "", "chapter": "", "publisher": "", "school": "", "doi": "", "urls_slides": [], "dblp": "", "citekey": "", "notes": "", "venue": "Proceedings of the 4th international symposium on  \u2026, 2006 - portal.acm.org", "urls_bibtex": ["http://scholar.google.com/scholar.bib?q=info:n_m_EivommMJ:scholar.google.com/&output=citation&hl=pl&ct=citation&cd=0"], "organization": ""}
]
}}}

== ADD PUBLICATIONS ==

Authenticated client can send batches of new publications via HTTP. Each record has
an ID provided by the client (Client ID).

=== Request ===

Records can be sent either as BibTex.

{{{POST /api/1.0/publications/add.json}}}

BibTex must be sent inside request body

==== Bibtex: ====

{{{
@book {1079,
title = {Reinventing cinema : movies in the age of media convergence},
year = {2009},
month = {2009},
publisher = {Rutgers University Press},
organization = {Rutgers University Press},
address = {New Brunswick, N.J.},
isbn = {9780813545462},
author = {Tryon, Chuck}
}
}}}

=== Response ===

Citation tracker returns the client a set of IDs for the new publications (CT IDs). The CT
IDs must be matched to the Client IDs. In the BibText example, the clientʼs ID for the
record is 1079.

{{{

[
  {"citracker_id": 225332275791453480108006911598620091955, "original_id":1079}
]
}}}

== EDIT PUBLICATION ==

Client sends an updated Publication record. Gets back response with updated publication or 404 error code if no publication was found.

=== Request ===

{{{POST /api/1.0/publications/update.json}}}

JSON object must be send in request body for example: 
{{{
{
  "key": "40787a1f-de3c-47a2-a12e-8635325c5db7", 
  "authors": ["a", "b", "c"], 
  "title": "Title",
  "address": "Dummy Address"
}
}}}

We identify our publication by using proper {{{key}}}

=== Response ===

As response we get the same format as with {{{publication/list.json}}} api call

{{{
[{"google_scholar_id": [], "isbn": "", "urls_other": [], "pub_type": "", "series": "", "authors": ["a", "b", "c"], "number": "", "edition": "", "title": "Title", "booktitle": "", "pages": "", "note": "", "eprint": "", "editor": "", "howpublished": "", "bibsource": "", "type": "", "urls_pdf": [], "tags": [], "journal": "", "volume": "", "key": "40787a1f-de3c-47a2-a12e-8635325c5db7", "address": "Dummy Address", "annote": "", "pub_date": "", "institution": "", "chapter": "", "publisher": "", "school": "", "doi": "", "urls_slides": [], "dblp": "", "citekey": "", "notes": "", "venue": "", "urls_bibtex": [], "organization": ""}]
}}}

== DELETE PUBLICATION ==

Deleta a publication that belongs to current user.

=== Request ===

{{{DELETE /api/1.0/publications/delete?key=553556a3-8872-443e-a89d-080c6c9683f7}}}

=== Response ===

Empty array if is succesfull 404 error code when not found or current user is not an owner.

{{{
[]
}}}

= CITATIONS =

== GET CITATIONS ==

=== Request ===

Client will use the citation tracker publication ID for the request. See examples:

{{{GET /api/1.0/citations/list.json?publication_key=f0299979-e580-4f4c-9201-925d7a6685dc}}}
[[BR]]
{{{GET /api/1.0/citations/list.json?publication_key=f0299979-e580-4f4c-9201-925d7a6685dc&state=keep}}}

=== Response ===

An array of citations objects with key attribute for referncing citations in other api calls.

{{{
[
  {"isbn": "", "urls_other": ["http://www.mimuw.edu.pl/~chrzaszcz/BPJ20067/canapa.pdf"], "pub_type": "", "series": "", "address": "", "number": "", "edition": "", "title": "Propagation of JML non-null annotations in Java programs", "booktitle": "", "pages": "", "note": "", "state": "keep", "eprint": "", "editor": "", "howpublished": "", "bibsource": "", "type": "publication", "urls_pdf": [], "journal": "", "volume": "", "key": "0fedaacc-3a2e-4f47-9a4d-62e878063504", "authors": [], "annote": "", "pub_date": "", "institution": "", "chapter": "", "publisher": "", "school": "", "doi": "", "urls_slides": [], "dblp": "", "citekey": "", "notes": "", "venue": "", "organization": ""}, 
  {"isbn": "", "urls_other": ["http://zls.mimuw.edu.pl/~alx/jml2bml/jml2bml.pdf"], "pub_type": "", "series": "", "address": "", "number": "", "edition": "", "title": "zls.mimuw.edu.pl/~alx/jml2bml/jml2bml.pdf", "booktitle": "", "pages": "", "note": "", "state": "keep", "eprint": "", "editor": "", "howpublished": "", "bibsource": "", "type": "publication", "urls_pdf": [], "journal": "", "volume": "", "key": "e6d09194-52c3-4f4a-843e-ab6c5783445a", "authors": [], "annote": "", "pub_date": "", "institution": "", "chapter": "", "publisher": "", "school": "", "doi": "", "urls_slides": [], "dblp": "", "citekey": "", "notes": "", "venue": "", "organization": ""}, 
  {"isbn": "", "urls_other": ["http://zls.mimuw.edu.pl/~alx/papers.php"], "pub_type": "", "series": "", "address": "", "number": "", "edition": "", "title": "Aleksy Schubert - papers", "booktitle": "", "pages": "", "note": "", "state": "keep", "eprint": "", "editor": "", "howpublished": "", "bibsource": "", "type": "publication", "urls_pdf": [], "journal": "", "volume": "", "key": "a3beeb39-6518-436e-822d-e427657e93a6", "authors": [], "annote": "", "pub_date": "", "institution": "", "chapter": "", "publisher": "", "school": "", "doi": "", "urls_slides": [], "dblp": "", "citekey": "", "notes": "", "venue": "", "organization": ""}, 
  {"isbn": "", "urls_other": ["http://dblp.uni-trier.de/db/indices/a-tree/j/Jancewicz:Lukasz.html"], "pub_type": "", "series": "", "address": "", "number": "", "edition": "", "title": "DBLP: Lukasz Jancewicz", "booktitle": "", "pages": "", "note": "", "state": "discard", "eprint": "", "editor": "", "howpublished": "", "bibsource": "", "type": "publication", "urls_pdf": [], "journal": "", "volume": "", "key": "f6b287ae-7dd1-415a-b1d7-a80cce9fe62f", "authors": [], "annote": "", "pub_date": "", "institution": "", "chapter": "", "publisher": "", "school": "", "doi": "", "urls_slides": [], "dblp": "", "citekey": "", "notes": "", "venue": "", "organization": ""}, 
  {"isbn": "", "urls_other": ["http://mobius.inria.fr/twiki/pub/DeliverablesList/WebHome/Deliv-3.10.pdf"], "pub_type": "", "series": "", "address": "", "number": "", "edition": "", "title": "Final Report on Program Verification Environment and ...", "booktitle": "", "pages": "", "note": "", "state": "for_later", "eprint": "", "editor": "", "howpublished": "", "bibsource": "", "type": "publication", "urls_pdf": [], "journal": "", "volume": "", "key": "a66a94b8-2d17-4041-ab56-56aa2fb3cf6a", "authors": [], "annote": "", "pub_date": "", "institution": "", "chapter": "", "publisher": "", "school": "", "doi": "", "urls_slides": [], "dblp": "", "citekey": "", "notes": "", "venue": "", "organization": ""}, 
  {"isbn": "", "urls_other": ["http://pl.linkedin.com/in/jancewicz"], "pub_type": "", "series": "", "address": "", "number": "", "edition": "", "title": "ukasz Jancewicz - LinkedIn", "booktitle": "", "pages": "", "note": "", "state": "", "eprint": "", "editor": "", "howpublished": "", "bibsource": "", "type": "publication", "urls_pdf": [], "journal": "", "volume": "", "key": "4b92a49f-f4aa-4c87-8983-206feb00b5b7", "authors": [], "annote": "", "pub_date": "", "institution": "", "chapter": "", "publisher": "", "school": "", "doi": "", "urls_slides": [], "dblp": "", "citekey": "", "notes": "", "venue": "", "organization": ""}, {"isbn": "", "urls_other": ["http://www.pdfgeni.com/ref/philip-guo-pdf.html"], "pub_type": "", "series": "", "address": "", "number": "", "edition": "", "title": "philip guo eBook Downloads", "booktitle": "", "pages": "", "note": "", "state": "", "eprint": "", "editor": "", "howpublished": "", "bibsource": "", "type": "publication", "urls_pdf": [], "journal": "", "volume": "", "key": "01d16a6f-e27d-4b8b-a757-fdad1d6cfb9a", "authors": [], "annote": "", "pub_date": "", "institution": "", "chapter": "", "publisher": "", "school": "", "doi": "", "urls_slides": [], "dblp": "", "citekey": "", "notes": "", "venue": "", "organization": ""}, 
  {"isbn": "", "urls_other": ["http://www.informatik.uni-trier.de/~ley/db/conf/pppj/pppj2006.html"], "pub_type": "", "series": "", "address": "", "number": "", "edition": "", "title": "Principles and Practice of Programming in Java 2006", "booktitle": "", "pages": "", "note": "", "state": "", "eprint": "", "editor": "", "howpublished": "", "bibsource": "", "type": "publication", "urls_pdf": [], "journal": "", "volume": "", "key": "bcd9b8d1-ed07-4f57-9b70-f4e03c879649", "authors": [], "annote": "", "pub_date": "", "institution": "", "chapter": "", "publisher": "", "school": "", "doi": "", "urls_slides": [], "dblp": "", "citekey": "", "notes": "", "venue": "", "organization": ""}, 
  {"isbn": "", "urls_other": ["http://www.cs.virginia.edu/~weimer/p/weimer-issre2008-preprint.pdf"], "pub_type": "", "series": "", "address": "", "number": "", "edition": "", "title": "Changing Java's Semantics for Handling Null Pointer Exceptions", "booktitle": "", "pages": "", "note": "", "state": "", "eprint": "", "editor": "", "howpublished": "", "bibsource": "", "type": "publication", "urls_pdf": [], "journal": "", "volume": "", "key": "c041ce39-75c3-4bcc-ac68-6a02c1060971", "authors": [], "annote": "", "pub_date": "", "institution": "", "chapter": "", "publisher": "", "school": "", "doi": "", "urls_slides": [], "dblp": "", "citekey": "", "notes": "", "venue": "", "organization": ""}
]
}}}

== CITATION STATE CHANGE ==

=== Request ===

{{{POST /api/1.0/citations/set_state.json}}}

JSON array must be send in request body for example: 
{{{
[
  {"key": "40787a1f-de3c-47a2-a12e-8635325c5db7", "state":"for_later"},
  {"key": "40787a1f-de3c-47a2-a12e-8635325c5db8", "state":"keep"}
]
}}}

We identify our citations by using proper {{{key}}}

Client sends an array of objects containing Citation keys and a state: ʻnewʼ ʻfor laterʼ ʻdiscardʼ or ʻkeepʼ. 

=== Response ===

Gets an empty response or error

== UPDATE CITATION ==
Client sends an updated Citation record. Gets back response or error.

=== Request ===

{{{POST /api/1.0/citations/update.json}}}

JSON object must be send in request body for example: 
{{{
{
  "key": "40787a1f-de3c-47a2-a12e-8635325c5db7", 
  "authors": ["a", "b", "c"], 
  "title": "Title",
  "address": "Dummy Address"
}
}}}

We identify our citation by using proper {{{key}}}

=== Response ===

As response we get the same format as with {{{/citations/list.json}}} api call

{{{
[{"google_scholar_id": [], "isbn": "", "urls_other": [], "pub_type": "", "series": "", "authors": ["a", "b", "c"], "number": "", "edition": "", "title": "Title", "booktitle": "", "pages": "", "note": "", "eprint": "", "editor": "", "howpublished": "", "bibsource": "", "type": "", "urls_pdf": [], "tags": [], "journal": "", "volume": "", "key": "40787a1f-de3c-47a2-a12e-8635325c5db7", "address": "Dummy Address", "annote": "", "pub_date": "", "institution": "", "chapter": "", "publisher": "", "school": "", "doi": "", "urls_slides": [], "dblp": "", "citekey": "", "notes": "", "venue": "", "urls_bibtex": [], "organization": ""}]
}}}

= MONITORING =

Using the term “Channel” to refer to the set of services (Google, Ask, Bing, etc.). Using
the term “Monitor” to refer to a particular instance under a publication.

== GET ALL CHANNELS ==

Client requests names (strings) and IDS for all possible channels (Ask, Google, Bing,
etc.).

=== Request ===

{{{GET /api/1.0/monitoring/list.json}}}

=== Response ===

Returns a list of all available monitoring services

{{{
[{"name": "ask"}, {"name": "bing"}, {"name": "citeseerx"}, {"name": "google"}, {"name": "libra"}, {"name": "ssrn"}, {"name": "yahoo"}]
}}}

== GET ALL ACTIVE MONITORS ==

Client requests all active monitors for a particular publication ID.

Citation Tracker returns a record for each active monitor, including: Monitor ID, Channel
ID, and Stored Query String.

=== Request ===

Client will use the citation tracker publication ID for the request. See example:

{{{
/api/1.0/monitoring/list_active.json?publication_key=049993c7-2ed3-42ec-8e03-1bd1e4e48003 
}}}

=== Response ===

Returns a list of active monitoring services for this particular publication, omits default alway active google_scholar monitoring

{{{
[{"name": "yahoo", "value": ["Test monitoring", "Test monitoring 2"]}]
}}}

Each monitoring may have multiple values, we identify particular monitoring by a composite key:

 * publication_key
 * monitoring name
 * monitoring value

== ADD MONITOR ==

Client can send and ʻaddʼ command with a Publication ID, channel name and channel value to add a
Monitor. 

=== Request ===

{{{POST /api/1.0/monitoring/add.json}}}

Json data must be encoded in request body example below:

{{{
{"publication_key": "181dd713-0a72-4f59-8bbd-519490675f79", "value": "test value", "name": "yahoo"}
}}}

=== Response ===

A list of active monitors for selected publication:

{{{
[{"name": "yahoo", "value": ["test value"]}]
}}}

== UPDATE MONITOR ==
Client can send an ʻupdateʼ command to change the query string for an active monitor.

=== Request ===

{{{POST /api/1.0/monitoring/add.json}}}

Json data must be encoded in request body example below:

{{{
{"new_value": "New monitoring", "old_value": "Test monitoring 2", "publication_key": "85edfd25-9350-4764-9acb-e35461b6a377", "name": "yahoo"}
}}}

=== Response ===

A list of active monitors for selected publication:

{{{
[{"name": "yahoo", "value": ["New monitoring"]}]
}}}

== DELETE MONITORING CHANNEL ==

Client can send a command with a monitoring channel ID to turn a monitor off / delete it.

=== Request ===

{{{DELETE /api/1.0/monitoring/delete.json?publication_key=e9286d73-04fe-4fdf-9ca6-f02c999309c4&value=Test+monitoring+2&name=yahoo}}}

=== Response ===

A list of active monitorings for current publication

{{{
[{"name": "yahoo", "value": ["New monitoring"]}]
}}}
