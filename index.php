<?php
    // This file is part of the rec_voz plugin for Moodle - http://moodle.org/
    //
    // Moodle is free software: you can redistribute it and/or modify
    // it under the terms of the GNU General Public License as published by
    // the Free Software Foundation, either version 3 of the License, or
    // (at your option) any later version.
    //
    // Moodle is distributed in the hope that it will be useful,
    // but WITHOUT ANY WARRANTY; without even the implied warranty of
    // MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    // GNU General Public License for more details.
    //
    // You should have received a copy of the GNU General Public License
    // along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

    /**
    * This page lists all the instances of nsmoo in a particular course
    *
    * @author  Wanderson Barbosa Duarte <wanderson.barbosa.duarte24@gmail.com>
    * @package block/rec_voz
    */
    include_once '../../config.php';
    require_once 'content_edit_form.php';

    $courseid = required_param('course', PARAM_INT);
    $id = required_param('id', PARAM_INT);

    if (!$instance = $DB->get_record('block_instances', array('id'=>$id))){
        print_error('errorbadblockinstance', 'block_rec_voz');
    }

    if (!$course = $DB->get_record('course', array('id'=>$courseid))){
        print_error('invalidcourseid');
    }

    require_login($course);

    $theBlock = block_instance('rec_voz', $instance);
    $blockcontext = context_block::instance($id);

    $PAGE->navbar->add(get_string('titleBlocklink', 'block_rec_voz'), null);	

    $PAGE->set_url($CFG->wwwroot.'/blocks/rec_voz/index.php?
    course='.$courseid.'&id='.$id);
    $PAGE->set_title($SITE->fullname);
    $PAGE->set_heading($SITE->shortname);
    echo $OUTPUT->header();

    //$data->id = $id;
    //$data->course = $courseid;
    // change proposed by jcockrell 
    //$data->text = $theBlock->config->text;
?>  
    
<?php
 ini_set('default_charset','UTF-8');
?>

<IFRAME src="conversao.php" width="900" height="850" scrolling="no" frameborder="0" align="center"></IFRAME>

<?php
	echo $OUTPUT->footer($course);
?>