import { createStore, applyMiddleware, combineReducers } from 'redux';
import thunk from 'redux-thunk';
import userReducer from './reducers/userReducer';
// Add other reducers as needed

const rootReducer = combineReducers({
  user: userReducer,
  // Add other reducers here
});

const store = createStore(rootReducer, applyMiddleware(thunk));

export default store;
