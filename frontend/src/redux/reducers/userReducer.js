const initialState = {
  isLoggedIn: false,
  user: null
};

function userReducer(state = initialState, action) {
  switch (action.type) {
    case 'SET_USER':
      return { ...state, isLoggedIn: true, user: action.payload };
    case 'LOGOUT_USER':
      return { ...state, isLoggedIn: false, user: null };
    default:
      return state;
  }
}

export default userReducer;
