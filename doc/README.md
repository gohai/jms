# How to use?


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


# Third-party software used

Bootstrap 3.3.5, downloaded from http://getbootstrap.com/getting-started/

FFmpeg 2.8.2, static build downloaded from http://johnvansickle.com/ffmpeg/

Isotope 2.2.2, downloaded from http://isotope.metafizzy.co/

jQuery 2.1.4, downloaded from https://jquery.com/

Open Sans Light, downloaded from https://google-webfonts-helper.herokuapp.com/
