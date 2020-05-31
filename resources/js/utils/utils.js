// Stall function (testing purpose) : slow down async behaviour
export const stall = async (stallTime = 1000) => {
    await new Promise(resolve => setTimeout(resolve, stallTime));
}