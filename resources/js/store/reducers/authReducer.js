const initState = {
    email: "",
    password: "",
    authError: null,
    uid: null,
    isAuth: false
};
const authReducer = (state = initState, action) => {
    switch (action.type) {
        case "SIGNIN_SUCCESS":
            return {
                ...state,
                authError: null,
                uid: action.uid,
                isAuth: true
            };
        case "SIGNIN_ERROR":
            return {
                ...state,
                authError: "Login Failed"
            };
        case "SIGNOUT_SUCCESS":
            return {
                ...state,
                authError: null,
                uid: null,
                isAuth: false
            };
        case "SIGNUP":
            return { ...state };
        default:
            return state;
    }
};
export default authReducer;
