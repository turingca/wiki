图灵知识库wiki
=====

thanks for mdwiki！

about
--------

  * __turingca__
  * [turingca](http://www.turingca.com)
  * 



Requirements
------------

* Webspace (or a web server that can serve static files)
* Any modern Webbrowser
* [mdwiki.html][download] file

How does it work?
-----------------

Just drop the `mdwiki.html` available from [the download page][download] along with your markdown files on a webspace somewhere. You can pass any url (relative to the `mdwiki.html` file) to mdwiki after the hashbang `#!`:

    http://www.example.com/mdwiki.html#!myfile.md

If you rename the `mdwiki.html` into `index.html`, you can omit the filename on most webservers:

    http://www.example.com/#!myfile.md

MDwiki will load a file called `index.md` from the same directory as the index.html by default, so if you use an `index.md` file as entry point, all you have to do is enter your domain name:

    http://example.com/

Note: There are lots more features over regular Markdown, check out the [quickstart tutorial][quickstart].

- - - -

Credits / Technologies
----------------------

MDwiki would not exist if it weren't for those great pieces of software:

  * [marked][marked]
  * [jQuery][jQuery]
  * [Bootstrap][bootstrap]
  * [Bootswatch][bootswatch]
  * [colorbox][colorbox]
  * [highlightjs][highlightjs]

MDwiki is created by Timo Dörr. Follow me to get updates on MDwiki! [Follow @timodoerr](http://www.twitter.com/timodoerr).

Cute kitten images provided by the great [placekitten.com] service.

  [download]: download.md
  [quickstart]: quickstart.md
  [gimmicks]: gimmicks.md

  [markdown]: http://daringfireball.net/projects/markdown/
  [jQuery]: http://www.jquery.org
  [bootstrap]: http://www.getbootstrap.com
  [bootswatch]: http://www.bootswatch.com
  [marked]: https://github.com/chjj/marked
  [colorbox]: http://www.jacklmoore.com/colorbox/
  [gists]: https://gist.github.com/
  [maps]: http://maps.google.com/
  [highlightjs]: https://highlightjs.org/
  [placekitten.com]: http://www.placekitten.com/

License
-------

MDwiki is licensed under [GNU GPLv3 with additional terms applied][license].

  [license]: https://github.com/Dynalon/mdwiki/blob/master/LICENSE.txt
