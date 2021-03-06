# How to use?


## Initial setup

The JODI folder needs to be writable for the webserver process. This can be done by
executing `chmod a+rwx JODI` in the terminal.


## Adding works

Create a subdirectory inside the JODI folder. The name of the subdirectory is also the
works *name*, used for the URL and referencing other works, so rather pick a short name
here, without any special characters.

Subdirectories inside the JODI folder that start with an underscore, are hidden. They
won't be displayed.


## Adding metadata

For a work to show up, it is also necessary to add a *meta.txt* file inside the
subdirectory. The content of this file needs to be valid JSON, or else the PHP
script will complain.

The expected format of this file is like this:

    {
    	"title": "Test Work 1",
    	"type": "Software",
    	"year": "2000/2002",
    	"sortYear": 2002,
    	"materials": ["wood", "clay"],
    	"reference": ["testwork2", "testwork3"],
    	"url_work": ["http://ns.nl/"]
    }

The metadata fields:

**title**: The long title of the work, which can include special characters. If this is not
set, the software will use work's (directory) *name* instead.

**type**: The type of work, as you want it to appear in the metadata column and in the filter
dropdown. Needs to be set.

**year**: The human-readable version of the year. This can have any format, and is solely used
for display. Can be left unset.

**sortYear**: This is a single number, which is used for sorting. The only other value this
can be set to is "ongoing" (with quotation marks), which means puts it always at the very
bottom of the list. Needs to be set.

**materials**: An array of materials. Can be left unset.

**reference**: An array of (directory) *name*s (not titles) of works that are related. Can be left
unset.

**url_work**: An array of URLs that are related to the work. Can be left unset.


## Adding descriptions

To add a description to a work, place HTML in a file called *description.html*. This file does
not exist for the work to show up.


## Adding media

Add media files in the respective directory in each work's directory. For example: exhibition
view shots for zyx would be placed in a directory "exibitionview" in the "zyx" directory.

Directories and files that start with an underscore are hidden.

The order in which the different categories show up is determined by the media_categories
variable in config.inc.php. To show the category "Exhibition view" before "Ephemera", move the
entry for the former ahead of the latter. If no ordering is defined, categories will simply be
ordered alphabetically.

With the media_categories variable in config.inc.php it is also possible to define a text (title)
for display (e.g. on the dropdown), that differs from the directory name, which is used by default.
With this, the directory could e.g. be called "exhibitionview", while the entry is displayed as
"Exhibition view".


## Adding media descriptions

In addition to actual media files, the category folders can also include a file named "list.txt" with
the following format

    foo.jpg: Exhibition "foo", Dordrecht, 2010
    bar.jpg: Exhibition "bar", Dordrecht, 2012

Everything before the first colon is the filename, everything after it is treated as the file's
descripion. By using this (optional) file, it is also possible to change the order in which the
media files are presented on the website. Here, "foo.jpg" is shown before "bar.jpg".

By default (without using a list file), media files are ordered alphabetically and have an empty
description.


## Adding primary representations

Each work can also contain one image or video file, which is being used as its primary
visual representation. Place this file directly in the work directory, along with the
meta.txt and description.html files. It can have any filename, but there can only be a
single one.

It is suggested to copy a file from one of the media subdirectories to be used as the
primary one, and to keep the original file (and description) in place.


# Third-party software used

Bootstrap 3.3.5, downloaded from http://getbootstrap.com/getting-started/

FFmpeg 2.8.2, static build downloaded from http://johnvansickle.com/ffmpeg/

Isotope 2.2.2, downloaded from http://isotope.metafizzy.co/

jQuery 2.1.4, downloaded from https://jquery.com/

Open Sans Light, downloaded from https://google-webfonts-helper.herokuapp.com/
