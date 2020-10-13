<cite>
    <?php 
        $a=0;
        foreach ($this->uri->segments as $segment): 
            $url = substr($this->uri->uri_string, 0, strpos($this->uri->uri_string, $segment)) . $segment;
            $is_active =  $url == $this->uri->uri_string;
            ?>
                <span class="text-black <?=$is_active ? 'active': '' ?>">
            <?php 
            if($is_active): 
                echo "<span class='text-muted'>- ".ucfirst($segment)."</span>";
            else: 
                if($a!=0) echo" / ";
                $a++;
                ?>
                    <a href="<?=site_url($url) ?>"> <?=ucfirst($segment)?> </a>
                <?php 
            endif; 
            ?>
                </span>
            <?php
        endforeach; 
    ?>
</cite>