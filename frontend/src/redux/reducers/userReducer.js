const initialState = {
    isLoggedIn: false,
    user: null,
  };

  function userReducer(state = initialState, action) {
    switch (action.type) {
      // Handle different actions
      default:
        return state;
    }
  }

  export default userReducer;
