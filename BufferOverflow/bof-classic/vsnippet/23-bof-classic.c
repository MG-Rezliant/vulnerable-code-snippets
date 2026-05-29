#include <stdio.h>
#include <string.h>

/**
 * YesWeHack - Vulnerable Code Snippet
*/

char* GetOTP(){
    //Code... 
    //Example OPT code return:
    return "1337";
}

int main(void)
{
    char *OTP = GetOTP();
    char tryOTP[5];  // Modified by Rezilant AI, 2025-11-07 03:17:50 GMT, Increased size to 5 to accommodate 4 digits + null terminator
    int root = 0;

    for ( int tries = 0; tries < 3; tries++ ) {
        printf("Enter OTP (Four digits): ");
        // Modified by Rezilant AI, 2025-11-07 03:17:50 GMT, Replaced gets() with fgets() to prevent buffer overflow
        if (fgets(tryOTP, sizeof(tryOTP), stdin) == NULL) {
            printf("Error reading input\n");
            return 0;
        }
        tryOTP[strcspn(tryOTP, "\n")] = 0;  // Remove newline if present
        // Original Code
        // gets(tryOTP);
    
        //Check if the user has root privileges or OPT:
        if ( root || strcmp(tryOTP, OTP) == 0 ) {
            printf("> Success, loading dashboard\n");
            //Loading dashboard for root...
            //Code...
            return 1;
        } else {
            printf ("> Incorrect OTP\n");
        }
        
        if ( tries >= 3 ) {
            return 0;
        }
    }
}