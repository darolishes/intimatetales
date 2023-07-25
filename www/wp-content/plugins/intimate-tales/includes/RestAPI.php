<?php
namespace IntimateTales;

defined('ABSPATH') || exit;

/**
 * The RestAPI class.
 *
 * @since 1.0.0
 */
class RestAPI {
    protected $settings;
    
    /**
     * Initialize the RestAPI class.
     *
     * @param Settings $settings The settings object.
     * @since 1.0.0
     */
    public function __construct(Settings $settings) {
        $this->settings = $settings;
        add_action('rest_api_init', [$this, 'register_routes']);
        add_filter('rest_allowed_cors_headers', [$this, 'add_cors_headers_for_user_registration'], 10, 2);
    }

    /**
     * Register the REST API routes.
     *
     * @since 1.0.0
     */
    public function register_routes() {
        register_rest_route('intimate-tales/v1', '/login', array(
            'methods' => 'POST',
            'callback' => array($this, 'login_user'),
        ));

        register_rest_route('intimate-tales/v1', '/register', array(
            'methods' => 'POST',
            'callback' => array($this, 'register_user'),
        ));

        register_rest_route('intimate-tales/v1', '/categories', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_categories'),
        ));

        register_rest_route('intimate-tales/v1', '/roleplays/(?P<id>\d+)', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_roleplay'),
        ));
    }

    /**
     * Get a specific roleplay.
     *
     * @since 1.0.0
     * @param \WP_REST_Request $request The request object.
     * @return $this->prepare_response($roleplay) The response object.
     */
    public function get_roleplay(\WP_REST_Request $request) {
        $roleplay_id = $request->get_param('id');
        $roleplay = get_post($roleplay_id);

        if (!$roleplay || $roleplay->post_type !== $this->settings->get_post_type()) {
            return new \WP_REST_Response('Roleplay not found', 404);
        }

        return $this->prepare_response($roleplay);
    }

    /**
     * Get all roleplay categories.
     *
     * @since 1.0.0
     * @param \WP_REST_Request $request The request object.
     * @return \WP_REST_Response The response object.
     */
    public function get_categories(\WP_REST_Request $request) {
        $categories = get_terms(array(
            'taxonomy' => $this->settings->get_taxonomy_slug(),
            'hide_empty' => false,
        ));

        return new \WP_REST_Response($categories, 200);
    }

    /**
     * Login a user.
     *
     * @since 1.0.0
     * @param \WP_REST_Request $request The request object.
     * @return \WP_REST_Response The response object.
     */
    public function login_user(\WP_REST_Request $request) {
        $username = $request->get_param('username');
        $password = $request->get_param('password');

        $user = wp_authenticate($username, $password);
        
        if (is_wp_error($user)) {
            return new \WP_REST_Response($user->get_error_message(), 401);
        }

        wp_set_current_user($user->ID, $user->user_login);
        wp_set_auth_cookie($user->ID);
        do_action('wp_login', $user->user_login, $user);

        return new \WP_REST_Response($user, 200);
    }

    /**
     * Register a user.
     *
     * @since 1.0.0
     * @param \WP_REST_Request $request The request object.
     * @return \WP_REST_Response The response object.
     */
    public function register_user(\WP_REST_Request $request) {
        $username = $request->get_param('username');
        $email = $request->get_param('email');
        $password = $request->get_param('password');
        
        $user_data = array(
            'user_login' => $username,
            'user_email' => $email,
            'user_pass' => $password,
        );
        
        $user_id = wp_insert_user($user_data);
        
        if (is_wp_error($user_id)) {
            return new \WP_REST_Response($user_id->get_error_message(), 400);
        }
        
        return new \WP_REST_Response('User registered successfully', 200);
    }

    /**
     * Prepare the response object.
     * 
     * @since 1.0.0
     * @param \WP_Post $post The post object.
     * @return $response The response object.
     */
    private function prepare_response(\WP_Post $post) {
        $response = new \WP_REST_Response();
        $response->set_data([
            'id' => $post->ID,
            'title' => $post->post_title,
            'content' => $post->post_content,
            'author' => $post->post_author,
            'story_mood' => get_field('story_mood', $post->ID),
            'story_type' => get_field('story_type', $post->ID),
            'story_characters' => get_field('story_characters', $post->ID),
            'story_duration' => get_field('story_duration', $post->ID),
            'story_difficulty' => get_field('story_difficulty', $post->ID),
            'interactive_elements' => get_field('interactive_elements', $post->ID),
            'decision_options' => get_field('decision_options', $post->ID),
            'story_rating' => get_field('story_rating', $post->ID),
        ]);
    
        return $response;
    }
    
    /**
     * Add the required CORS headers for user registration.
     *
     * @param string $headers The CORS headers.
     * @param \WP_REST_Request $request The request object.
     * @return string The modified CORS headers.
     */
    public function add_cors_headers_for_user_registration($headers, $request) {
        $method = $request->get_method();
        if ('POST' === $method && '/wp/v2/users' === $request->get_route()) {
            $headers .= 'Access-Control-Allow-Origin: *' . "\r\n";
            $headers .= 'Access-Control-Allow-Methods: POST' . "\r\n";
            $headers .= 'Access-Control-Allow-Headers: Content-Type' . "\r\n";
        }
        return $headers;
    }
}
