# Facebook-Comments-to-Wordpress-format-for-Disqus


Open page-facebook-to-disqus.php, set the facebook app ID and client tokens at the top of the template. [you can add other post types is needed]

Upload page template to wordpress theme, then create a new page that uses this template.

View the page.... 

ex: http://mysite/the-page-name/

view the page source and copy the items to a new file... 

repeat for as many loops you need to get all the posts...

http://mysite/the-page-name/?paged=2
http://mysite/the-page-name/?paged=3
http://mysite/the-page-name/?paged=4
http://mysite/the-page-name/?paged=5
http://mysite/the-page-name/?paged=6

after you've gotten all the items, wrap the file in the below xml tags.

`<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0"
  xmlns:content="http://purl.org/rss/1.0/modules/content/"
  xmlns:dsq="http://www.disqus.com/"
  xmlns:dc="http://purl.org/dc/elements/1.1/"
  xmlns:wp="http://wordpress.org/export/1.0/"
><channel>
<-- put outputted items here -->
</channel>
</rss>`

you can now upload this file to disqus to import your facebook comments.
