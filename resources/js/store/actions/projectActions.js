export const createProject = project => {
    return (dispatch, getState) => {
        //make async call
        dispatch({ type: "CREATE_PROJECT", project: project });
    };
};
