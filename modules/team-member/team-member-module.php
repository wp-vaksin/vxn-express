<?php
namespace VXN\Express\Team_Member;

use VXN\Express;
use VXN\Express\Fields\Email_Field;
use VXN\Express\Fields\Text_Field;
use VXN\Express\Fields\URL_Field;
use VXN\Express\WP\Post_Type\Post_Type;
use VXN\Express\Section\Section;
use VXN\Express\WP\Taxonomy\Taxonomy;
use VXN\Express\Module_Interface;

/** @package VXN\Express\Testi */
class Team_Member_Module implements Module_Interface
{
  /** @inheritDoc */
    public static function name()
    {
        return 'Team Members';
    }

    /** @inheritDoc */
    public static function slug()
    {
        return 'vxn_express_team_member';
    }

    /** @inheritDoc */
    public function run(){
        define('VXN_EXPRESS_TEAM_MEMBER_DOMAIN', 'vxn-express-team-member');
        define('VXN_EXPRESS_TEAM_MEMBER_MODULE_FILE', __FILE__);
        // define('VXN_EXPRESS_TEAM_MEMBER_MODULE_PATH', plugin_dir_path(__FILE__));
        // define('VXN_EXPRESS_TEAM_MEMBER_MODULE_URL', plugin_dir_url(__FILE__));

        load_plugin_textdomain(VXN_EXPRESS_TEAM_MEMBER_DOMAIN, false, dirname(plugin_basename(VXN_EXPRESS_TEAM_MEMBER_MODULE_FILE)) . '/languages');

        add_action('vxn_express_loaded', function () {
            Express::add_post_type($this->team_member_post_type());
        });
    }

    /** @return Post_Type  */
    private function team_member_post_type(){
        $post_type = (new Post_Type(
            'vxn_team_member',
            __('Team Members', VXN_EXPRESS_TEAM_MEMBER_DOMAIN),
            __('Team Member', VXN_EXPRESS_TEAM_MEMBER_DOMAIN),
            __('Team Members', VXN_EXPRESS_TEAM_MEMBER_DOMAIN)
        ))
        ->set_menu_icon('dashicons-groups')
        ->set_enter_title_here(__('Enter Member Name Here', VXN_EXPRESS_TEAM_MEMBER_DOMAIN))
        ->add_supports('thumbnail')
        ->add_section(
            (new Section('member_info'))
            ->set_title(__('Member Information', VXN_EXPRESS_TEAM_MEMBER_DOMAIN))
            ->add_field(
                (new Email_Field('vxn_email'))
                ->set_title(__('Email', VXN_EXPRESS_TEAM_MEMBER_DOMAIN))
                ->set_enable_avatar(true)
            )
            ->add_field(
                (new Text_Field('vxn_member_info'))
                ->set_title(__('Member Info', VXN_EXPRESS_TEAM_MEMBER_DOMAIN))
            )
        )
        ->add_section(
            (new Section('social_info'))
            ->set_title(__('Social Information', VXN_EXPRESS_TEAM_MEMBER_DOMAIN))
            ->add_field(
                (new URL_Field('txt_facebook_url'))            
                ->set_title(__('Facebook URL', VXN_EXPRESS_TEAM_MEMBER_DOMAIN))
            )
            ->add_field(
                (new URL_Field('txt_instagram_url'))            
                ->set_title(__('Instagram URL', VXN_EXPRESS_TEAM_MEMBER_DOMAIN))
            )
            ->add_field(
                (new URL_Field('txt_twitter_url'))            
                ->set_title(__('Twitter URL', VXN_EXPRESS_TEAM_MEMBER_DOMAIN))
            )
            ->add_field(
                (new URL_Field('txt_youtube_url'))            
                ->set_title(__('Youtube URL', VXN_EXPRESS_TEAM_MEMBER_DOMAIN))
            )
            ->add_field(
                (new URL_Field('txt_linkedin_url'))
                ->set_title(__('LinkedIn URL', VXN_EXPRESS_TEAM_MEMBER_DOMAIN))
            )
        )
        ->add_taxonomy(
            new Taxonomy(
                'team_member_category',
                __('Team Member Categories', VXN_EXPRESS_TEAM_MEMBER_DOMAIN),
                __('Team Member Category', VXN_EXPRESS_TEAM_MEMBER_DOMAIN),
                __('Team Member Categories', VXN_EXPRESS_TEAM_MEMBER_DOMAIN)
            )
        );
        return $post_type;
    }
}
