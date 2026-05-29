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
    char tryOTP[4];
    int root = 0;

    for ( int tries = 0; tries < 3; tries++ ) {
        printf("Enter OTP (Four digits): ");
        // Modified by Rezilant AI, 2025-11-11 09:53:38 GMT, Replace gets() with fgets() to prevent buffer overflow
        fgets(tryOTP, sizeof(tryOTP), stdin);
        tryOTP[strcspn(tryOTP, "\n")] = 0;
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