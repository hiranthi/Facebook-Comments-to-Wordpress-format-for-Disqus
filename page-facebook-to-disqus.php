<?php 
/**
 * Template Name: Facebook to Disqus
*/
        
        /* you must set these 2 fields to your FB app settings */
        $fbAPPID = "000000";
        $fbClientToken = "0000000";
        

        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $args = array('post_type' => 'post', 'posts_per_page'  => 200, 'paged' => $paged);
        $my_query = new WP_Query($args); 
        while ($my_query->have_posts()) : $my_query->the_post(); 
            $permalink = get_permalink(get_the_ID());
            $json = json_decode(file_get_contents("https://graph.facebook.com/?id=$permalink&access_token=$fbAPPID|$fbClientToken"), true);
        if (!empty($json['og_object']['id'])) {
            $fbID = $json['og_object']['id'];
            $data = json_decode(file_get_contents("https://graph.facebook.com/$fbID/comments?&access_token=$fbAPPID|$fbClientToken"), true);
   
    
            $data = $data['data'];
            
            foreach($data as $comment){


	?>
		<item>
			<title></title>
			<link><?php echo $permalink; ?></link>
			<content:encoded><![CDATA[<?php echo $comment['message'];?>]]></content:encoded>
			<dsq:thread_identifier></dsq:thread_identifier>
			<wp:post_date_gmt></wp:post_date_gmt>
			<wp:comment_status>open</wp:comment_status>
			<wp:comment>
				<!-- sso only; see docs -->
				<dsq:remote>
				  <!-- unique internal identifier; username, user id, etc. -->
				  <dsq:id></dsq:id>
				  <!-- avatar -->
				  <dsq:avatar></dsq:avatar>
				</dsq:remote>
				<!-- internal id of comment -->
				<wp:comment_id><?php echo $comment['id']; ?></wp:comment_id>
				<!-- author display name -->
				<wp:comment_author><?php echo $comment['from']['name']; ?></wp:comment_author>
				<!-- author email address -->
				<wp:comment_author_email></wp:comment_author_email>
				<!-- author url, optional -->
				<wp:comment_author_url></wp:comment_author_url>
				<!-- author ip address -->
				<wp:comment_author_IP></wp:comment_author_IP>
				<!-- comment datetime, in GMT. Must be YYYY-MM-DD HH:MM:SS 24-hour format. -->
				<wp:comment_date_gmt><?php echo date('Y-m-d H:i:s', strtotime($comment['created_time']))?></wp:comment_date_gmt>
				<!-- comment body; use cdata; html allowed (though will be formatted to DISQUS specs) -->
				<wp:comment_content><![CDATA[<?php echo $comment['message'];?>]]></wp:comment_content>
				<!-- is this comment approved? 0/1 -->
				<wp:comment_approved>1</wp:comment_approved>
				<!-- parent id (match up with wp:comment_id) -->
				<wp:comment_parent>0</wp:comment_parent>
			</wp:comment>
		</item>
	<?php
			} 

        }
      
        endwhile; 

?>